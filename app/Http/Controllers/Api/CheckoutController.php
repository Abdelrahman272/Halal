<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
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
            if ($couponCode)
            {
                $coupon = Coupon::where('code', $request->coupon_code)
                ->where('start_date', '>=', now())
                ->where('end_date', '>=', now())
                ->where('max_uses', '>' ,0)
                ->where('user_limit', '>=', 1)
                ->where('used_count', '>=', 0)
                ->first();
            }
            else{
                $coupon = null;
            }

            $discount = 0;
            if ($coupon)
            {
                if ($coupon->discount_type === 'percentage') {
                    $discount = $totalPrice * $coupon->discount_amount / 100;
                } else {
                    $discount = $coupon->discount_amount;
                }

                $coupon->max_uses--;
                $coupon->used_count++;

                $coupon->save();

                $order = new Order();
                $order->first_name = $request->first_name;
                $order->last_name = $request->last_name;
                $order->phone = $request->phone;
                $order->address = $request->address;
                $order->city = $request->city;
                $order->discount = $discount;
                $order->user_id = $user->id;
                $order->coupon_id = $coupon->id;
                $order->total = $totalPrice - $discount;
                $order->save();
            }


            // Create the order

            if(!$coupon)
            {
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
            }

            foreach ($cartItems as $cartItem)
            {
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

            return $this->apiResponse($e, 'Something went wrong', 500);
            DB::rollback();
            // return $this->apiResponse($e, 'Something went wrong', 500);
        }
    }





























    // public function checkout(CheckOutRequest $request)
    // {
    // DB::beginTransaction();

    // try {

    //         $user = Auth::user();
    // $cart = Cart::where('user_id', Auth::id())->first();
    // $cartItems = $cart->items;
    //         $total = 0;

    //         foreach ($cartItems as $cartItem)
    //         {
    //             $total += $cartItem->price * $cartItem->quantity;
    //         }

    // $order = new Order();
    // $order->user_id = Auth::id();
    // $order->total = $total;
    // $order->save();

    // foreach ($cartItems as $cartItem) {
    //     $item = new OrderItem();
    //     $item->order_id = $order->id;
    //     $item->product_id = $cartItem->product_id;
    //     $item->quantity = $cartItem->quantity;
    //     $item->price = $cartItem->price;
    //     $item->save();

    //     $cartItem->delete();
    // }
    //         DB::commit();

    //         return $this->apiResponse($order, 'Order created successfully', 200);

    //     } catch (\Exception $e) {

    //         DB::rollback();

    //         return $this->apiResponse($e, 'Something went wrong', 500);
    //     }
    // }

    // public function checkout(CheckOutRequest $request)
    // {
    //     // Get the current user
    //     $user = Auth::user();

    //     DB::beginTransaction();

    //     try {
    //         // Get the cart items
    //         $cart = Cart::where('user_id', Auth::id())->first();
    //         if (!$cart) {
    //             return response()->json(['error' => 'Cart is empty'], 400);
    //         }

    //         $cartItems = $cart->items;

    //         // Calculate the total amount of the cart
    //         $totalAmount = 0;
    //         foreach ($cartItems as $cartItem) {
    //             $totalAmount += $cartItem->product->price * $cartItem->quantity;
    //         }

    //         // Get the coupon code from the request
    //         $couponCode = $request->code;

    //         // Check if the coupon code is valid
    //         $coupon = Coupon::where('code', $couponCode)
    //             ->where('start_date', '<=', now())
    //             ->where('end_date', '>=', now())
    //             ->where('max_uses', '<=', DB::raw('max_uses'))
    //             ->orWhere(function ($query) use ($couponCode) {
    //                 $query->where('code', $couponCode)
    //                     ->where('start_date', '<=', now())
    //                     ->where('end_date', '>=', now())
    //                     ->where('used_count', '<', DB::raw('max_uses'));
    //             })->first();

    //         if ($coupon) {
    //             // Calculate the discount based on the coupon type
    //             if ($coupon->type == 'percentage') {
    //                 $discountAmount = ($coupon->discount / 100) * $totalAmount;
    //             } else {
    //                 $discountAmount = $coupon->discount;
    //             }

    //             // Calculate the new total amount
    //             $totalAmount -= $discountAmount;

    //             // Create the order
    //             $order = new Order([
    // 'user_id' => $request->user->id,
    // 'total_amount' => $request->totalAmount,
    // 'coupon_id' => $request->coupon->id,
    // 'first_name' => $request->first_name,
    // 'last_name' => $request->last_name,
    // 'email' => $request->email,
    // 'phone' => $request->phone,
    // 'address' => $request->address,
    // 'city' => $request->city,
    // 'country' => $request->country,
    // 'postal_code' => $request->postal_code,
    // 'total_price' => $request->total_price,
    // 'discount' => $discountAmount,
    //             ]);
    //             $order->save();

    //             // Update the coupon usage count
    //             $coupon->used_count += 1;
    //             $coupon->save();

    //             // Create the order items
    //             foreach ($cartItems as $cartItem) {
    //                 $orderItem = new OrderItem();
    //                 $orderItem->order_id = $order->id;
    //                 $orderItem->product_id = $cartItem->product->id;
    //                 $orderItem->quantity = $cartItem->quantity;
    //                 $orderItem->price = $cartItem->product->price;
    //                 $orderItem->save();
    //             }

    //             // Clear the cart
    //             $cartItem->delete();

    //             // Return the order details
    //             return response()->json([
    //                 'order_id' => $order->id,
    //                 'total_amount' => $order->total_amount,
    //                 'coupon' => [
    //                     'code' => $coupon->code,
    //                     'discount' => $coupon->discount,
    //                     'type' => $coupon->type,
    //                     'discount_amount' => $discountAmount,
    //                 ],
    //             ]);
    //         } else {
    //             $order = new Order();
    //             $order->user_id = Auth::id();
    //             $order->total = $totalAmount;
    //             $order->save();

    // foreach ($cartItems as $cartItem) {
    //     $item = new OrderItem();
    //     $item->order_id = $order->id;
    //     $item->product_id = $cartItem->product_id;
    //     $item->quantity = $cartItem->quantity;
    //     $item->price = $cartItem->price;
    //     $item->save();

    //     $cartItem->delete();
    // }
    //         }

    //         DB::commit();

    //     } catch (\Exception $e) {

    //         DB::rollback();
    //         return $this->apiResponse($e, 'Something went wrong', 500);
    //     }
    // }

}
