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
    
        //Ambil user order ini atau create baru dengan value default
   
        $order = Order::where('user_id', $userId)->first();
        if (!$order) {
            $order = new Order();
            $order->user_id = $userId;
            $order->alamat_pengiriman = 'insert address'; // Default value
            $order->kode_pos = '11111'; // Default value
            $order->save();
        }
    
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
    
    
    public function removeFromCart($id)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)
            ->where('id', $id)
            ->delete();
    
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
    
    //ORDER CONTROLLERS

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
        $order->save(); // Custom order number di set saat ini serta default value lain agar ndak error

        // Hubungkan car dengna order
        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $cart) {
            $cart->order_id = $order->id;
            $cart->save();
        }

        return redirect()->route('order.show', $order->order_number)->with('success', 'Order created successfully!');
    }

    public function show($order_number)
    {
        $order = Order::where('order_number', $order_number)->with('carts.barang')->firstOrFail();

        return view('order.show', compact('order'));
    }

    public function orderUpdate(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos' => 'required|string|size:5',
        ]);
    
        //Cari order based on idnya
        $order = Order::find($request->input('order_id'));
    
        // Update isi order
        $order->alamat_pengiriman = $request->input('alamat_pengiriman');
        $order->kode_pos = $request->input('kode_pos');
        $order->save();
    
        return redirect()->route('getCart')->with('success', 'Order updated successfully!');
    }


    public function createNewOrder(Request $request)
{
    $request->validate([
        'alamat_pengiriman' => 'required|string|min:10|max:100',
        'kode_pos' => 'required|string|size:5',
    ]);

    $userId = Auth::id();

    // Buat order baru
    $order = new Order();
    $order->user_id = $userId;
    $order->alamat_pengiriman = $request->input('alamat_pengiriman');
    $order->kode_pos = $request->input('kode_pos');
    $order->save();

    // Hubungkan relasi order dan pengguna
    $cartItems = Cart::where('user_id', $userId)->get();
    foreach ($cartItems as $cart) {
        $cart->order_id = $order->id;
        $cart->save();
    }

    // 
    return redirect()->route('getCart')->with('success', 'New order created successfully!');
}

    
    
}
