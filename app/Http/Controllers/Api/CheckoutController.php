<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

class CheckoutController extends Controller
{

    use ResponseTrait;

    public function store()
    {
        DB::beginTransaction();

        try {

            $cart = Cart::where('user_id', Auth::id())->first();
            $cartItems = $cart->items;
            $total = 0;

            foreach ($cartItems as $cartItem)
            {
                $total += $cartItem->price * $cartItem->quantity;
            }

            $order = new Order();
            $order->user_id = Auth::id();
            $order->total = $total;
            $order->save();


            foreach ($cartItems as $cartItem) {
                $item = new OrderItem();
                $item->order_id = $order->id;
                $item->product_id = $cartItem->product_id;
                $item->quantity = $cartItem->quantity;
                $item->price = $cartItem->price;
                $item->save();

                $cartItem->delete();
            }
            DB::commit();

            return $this->apiResponse($order, 'Order created successfully', 200);

        } catch (\Exception $e) {

            DB::rollback();

            return $this->apiResponse($e, 'Something went wrong', 500);
        }
    }
}
