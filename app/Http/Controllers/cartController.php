<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function getCart()
    {
        $userId = Auth::id(); 
        $cartItems = Cart::where('user_id', $userId)
            ->with('barang') // Fetch related barang data
            ->get();

    
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->barang->hargaBarang * $item->quantity;
        });

        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }

    public function addToCart(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id(); 
        $cart->quantity = 1;
        $cart->barang_id = $request->input('barang_id');
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function updateCart(Request $request)
{
    $userId = Auth::id(); 

    foreach ($request->input('quantity') as $cartId => $quantity) {
        $cart = Cart::where('user_id', $userId)
                    ->where('id', $cartId)
                    ->first();
        
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
        }
    }

    return redirect()->back()->with('success', 'Cart updated successfully!');
}

public function removeFromCart($cartId)
{
    $userId = Auth::id(); 

    $cartItem = Cart::where('id', $cartId)
                    ->where('user_id', $userId)
                    ->first();

    if ($cartItem) {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Item removed from cart!');
    } else {
        return redirect()->back()->with('error', 'Item not found!');
    }
}




}
