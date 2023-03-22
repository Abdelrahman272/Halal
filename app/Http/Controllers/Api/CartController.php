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

    // public function addToCart(Request $request)
    // {
    //     // $product = Product::find($request->product_id);

    //     $product = Product::where('id', $request->product_id)->first();

    //     if (!$product) {
    //         return response()->json(['error' => 'Product not found.'], 404);
    //     }

    //     $cart = session()->get('cart');

    //     // If the cart is empty, create a new one
    //     if (!$cart) {
    //         $cart = [
    //             $product->id => [
    //                 "name" => $product->name,
    //                 "quantity" => $request->quantity,
    //                 "price" => $product->price*$request->quantity,
    //             ]
    //         ];

    //         session()->put('cart', $cart);

    //         // return response()->json(['success' => 'Product added to cart.']);

    //         return $this->apiResponse($cart, 'Product added to cart.', 200);
    //     }
    // }

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
            'price' => $product->price*$quantity,
        ]);

        return $this->apiResponse($cartItem, 'Products retrieved successfully', 200);

        // return response()->json(['message' => 'Product added to cart', 'cart' => $cartItem], 200);
    }

    public function removeItem(Request $request)
    {
        $productId = $request->input('product_id');

        // TODO: validate input data

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found in cart']);
        }
    }

    public function updateItem(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // TODO: validate input data

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found in cart']);
        }
    }

    // public function getCart()
    // {
    //     $cart = Session::get('cart', []);

    //     // return response()->json(['cart' => $cart]);
    //     return $this->apiResponse($cart, 'Cart Item', 200);
    // }
}
