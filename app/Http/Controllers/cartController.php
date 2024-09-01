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

        // Retrieve the current order for the user, or create a new one with default values
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

    //ORDER

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
        $order->save(); // At this point, the custom `order_number` is generated

        // Associate carts with this order
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

    public function update(Request $request)
    {
        // Validate the input
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'alamat_pengiriman' => 'required|string|min:10|max:100',
            'kode_pos' => 'required|string|size:5',
        ]);

        // Find the order by ID
        $order = Order::find($request->input('order_id'));

        if ($order) {
            // Update the order details
            $order->alamat_pengiriman = $request->input('alamat_pengiriman');
            $order->kode_pos = $request->input('kode_pos');
            $order->save();

            return redirect()->back()->with('success', 'Order updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Order not found!');
        }
    }
}
