<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function getCart(){
        $barang = Barang::all();
        return view('cart', compact('barang'));
    }

    public function addToCart(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id(); // Get the authenticated user's ID
        $cart->quantity = 1;
        $cart->barang_id = $request->input('barang_id');
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart!');
    }
}
