<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    use ResponseTrait;

    public function getCart()
    {
        $cart = Cart::get();
        return $this->apiResponse($cart, 'Cart retrieved successfully', 200);
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cartItem = Cart::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price * $quantity,
        ]);

        return $this->apiResponse($cartItem, 'Products retrieved successfully', 200);

        // return response()->json(['message' => 'Product added to cart', 'cart' => $cartItem], 200);
    }

    public function removeItem(Request $request)
    {
        $productId = $request->input('product_id');
        $cartItem = Cart::where('product_id', $productId)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }

        $cartItem->delete();

        return $this->apiResponse($cartItem, 'Cart Item Deleted Successfully', 200);
    }

    public function updateItem(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Cart::findOrFail($product_id);
        // $product->update($request->all());

        $product->updated([
            'quantity' => $quantity,
            'price' => $request->price * $quantity,
        ]);


        return $this->apiResponse($product, 'Products retrieved successfully', 200);

    }

}
