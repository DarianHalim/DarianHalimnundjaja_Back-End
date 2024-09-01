@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->order_number }}</h1>

    <h2>Order Details</h2>
    <p><strong>Address:</strong> {{ $order->alamat_pengiriman }}</p>
    <p><strong>ZIP Code:</strong> {{ $order->kode_pos }}</p>

    <h2>Items</h2>
    @if ($order->carts->isEmpty())
        <p>No items found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->carts as $cart)
                    <tr>
                        <td>{{ $cart->barang->namaBarang }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->barang->hargaBarang }}</td>
                        <td>${{ $cart->barang->hargaBarang * $cart->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Grand Total</th>
                    <th>${{ $order->carts->sum(function($cart) {
                        return $cart->barang->hargaBarang * $cart->quantity;
                    }) }}</th>
                </tr>
            </tfoot>
        </table>
    @endif
</div>
@endsection
