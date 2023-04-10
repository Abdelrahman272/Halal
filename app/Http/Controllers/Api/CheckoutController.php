<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UsedCopon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Termwind\Components\Dd;

class CheckoutController extends Controller
{

    use ResponseTrait;

    public function checkout(CheckOutRequest $request)
    {

        DB::beginTransaction();

        try {
            $user = Auth::user();

            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItems = $cart->items;

            // Calculate the total price of the cart items
            $totalPrice = 0;

            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem->product->price * $cartItem->quantity;
            }

            // Check if a coupon code was provided
            $couponCode = $request->input('coupon_code');

            // Get the coupon if a code was provided
            if ($couponCode) {
                $coupon = Coupon::where('code', $request->coupon_code)
                    ->where('start_date', '>=', now())
                    ->where('end_date', '>=', now())
                    ->where('max_uses', '>', 0)
                    ->where('user_limit', '>=', 1)
                    ->where('used_count', '>=', 0)
                    ->first();
            } else {
                $coupon = null;
            }

            $discount = 0;


            if ($coupon) {

                $usedCoupon = UsedCopon::where('user_id', $user->id)->where('coupon_id', $coupon->id)->first();

                if (!$usedCoupon) {
                    UsedCopon::create([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                    ]);

                    if ($coupon->discount_type === 'percentage') {
                        $discount = $totalPrice * $coupon->discount_amount / 100;
                    } else {
                        $discount = $coupon->discount_amount;
                    }

                    $coupon->max_uses--;
                    $coupon->used_count++;

                    $coupon->save();
                } else {
                    return $this->apiResponse($usedCoupon, 'This Coupon Is Already Used', 200);
                }
            }

            $order = new Order();
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->discount = $discount;
            $order->user_id = $user->id;
            $order->total = $totalPrice - $discount;
            $order->save();

            foreach ($cartItems as $cartItem) {
                $item = new OrderItem();
                $item->order_id = $order->id;
                $item->product_id = $cartItem->product_id;
                $item->quantity = $cartItem->quantity;
                $item->price = $cartItem->price;
                $item->save();

                $cartItem->delete();

                DB::commit();
            }
            return $this->apiResponse($order, 'Order Create Successfully', 200);
        } catch (\Exception $e) {
            return $e;
            return $this->apiResponse($e, 'Something went wrong', 500);
            DB::rollback();
        }
    }

}
