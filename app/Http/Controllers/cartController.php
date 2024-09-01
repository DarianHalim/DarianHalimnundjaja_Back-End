<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Barang;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function getCart()
    {
        $userId = Auth::id(); 
        $cartItems = Cart::where('user_id', $userId)
            ->with('barang') 
            ->get();
    
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->barang->hargaBarang * $item->quantity;
        });
    
        // Retrieve the current order for the user, or create a new one
        $order = Order::firstOrCreate(['user_id' => $userId]);
    
        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'order' => $order
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

    public function store(Request $request)
{
    $request->validate([
        'alamat_pengiriman' => 'required|string|min:10|max:100',
        'kode_pos' => 'required|string|size:5',
    ]);

    $order = new Order();
    $order->user_id = Auth::id();
    $order->alamat_pengiriman = $request->input('alamat_pengiriman', 'insert address');
    $order->kode_pos = $request->input('kode_pos', '11111');
    $order->save();

    // Associate carts with this order
    $cartItems = Cart::where('user_id', Auth::id())->get();
    foreach ($cartItems as $cart) {
        $cart->order_id = $order->id;
        $cart->save();
    }

    return redirect()->route('order.show', $order->id)->with('success', 'Order created successfully!');
}

public function show($id)
{
    $order = Order::with('carts.barang')->find($id);

    return view('order.show', compact('order'));
}

public function update(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'alamat_pengiriman' => 'required|string|min:10|max:100',
        'kode_pos' => 'required|string|size:5',
    ]);

    $order = Order::find($request->order_id);
    if ($order) {
        $order->alamat_pengiriman = $request->input('alamat_pengiriman');
        $order->kode_pos = $request->input('kode_pos');
        $order->save();

        return redirect()->back()->with('success', 'Order updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Order not found!');
    }
}

}