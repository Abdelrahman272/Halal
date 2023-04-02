<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    use ResponseTrait;

    public function getCart(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart ?? new Cart();
        $cart->load('items.product');

        return $this->apiResponse($cart, 'Cart retrieved successfully', 200);
    }


    public function addToCart(Request $request)
    {
        DB::beginTransaction();

        try {

            $user = $request->user();
            $cart = $user->cart ?? new Cart();
            $cart->user_id = $user->id;
            $cart->save();

            $product = Product::findOrFail($request->input('product_id'));

            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity'),
                'price' => $product->price * $request->input('quantity'),
            ]);

            $cartItem->save();
            DB::commit();

            return $this->apiResponse($cartItem, 'Cart Item Added Successfully', 200);

        } catch (\Exception $e) {

            DB::rollback();

            return $this->apiResponse($e, 'Something went wrong', 500);
        }
    }


    public function updateItem(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $productPrice = Product::findOrFail($cartItem->product_id);
        $cartItem->quantity = $request->quantity;
        $cartItem->price = $productPrice->price * $request->quantity;
        $cartItem->update();

        return $this->apiResponse($cartItem, 'Products retrieved successfully', 200);
    }

    public function removeCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return $this->apiResponse($cartItem, 'success', 'Product removed from cart.', 200);
    }

    public function destroy(Request $request, CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

}
