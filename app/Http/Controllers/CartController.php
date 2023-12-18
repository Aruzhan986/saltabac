<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        return response()->json($cartItems);
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,item_id', // Изменено на 'item_id'
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::create([
            'item_id' => $validatedData['item_id'],
            'user_id' => $user->id,
            'quantity' => $validatedData['quantity']
        ]);

        return response()->json($cartItem, 201);
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $cartItem = CartItem::where('item_id', $id)->where('user_id', $user->id)->firstOrFail(); // Изменено на 'item_id'
        $cartItem->delete();

        return response()->json(null, 204);
    }

    public function addToCart(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,item_id', // Изменено на 'item_id'
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::create([
            'item_id' => $validatedData['item_id'],
            'user_id' => $user->id,
            'quantity' => $validatedData['quantity']
        ]);

        return response()->json($cartItem, 201);
    }
}
