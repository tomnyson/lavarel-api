<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Get all cart items for a user
    public function index(Request $request)
    {
        $user = $request->user(); // Authenticated user
        $cart = Cart::where('user_id', $user->id)->with('product')->get();
        return response()->json($cart);
    }

    // Add an item to the cart
    public function add(Request $request)
    {
        $user = $request->user(); // Authenticated user

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->quantity,
            ]
        );

        return response()->json($cartItem);
    }

    // Remove an item from the cart
    public function remove($id, Request $request)
    {
        $user = $request->user(); // Authenticated user
        $cartItem = Cart::where('user_id', $user->id)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Item removed']);
        }

        return response()->json(['error' => 'Item not found'], 404);
    }
}
