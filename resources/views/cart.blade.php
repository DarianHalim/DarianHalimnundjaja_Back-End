<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=Cart, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/userStyleSheet.css') }}">
    <title>Cart</title>
</head>

<body>

    <div class="containerDiv">

        <div class="topHeader">
            <div class="navbarContainer">
                <span><a href="{{ route('getKatalog') }}">Katalog</a></span>
                <span>Faktur for {{ Auth::user()->name }}</span>
                <span><a href="{{ route('home') }}">Leave</a></span>
            </div>
        </div>
    </div>

    <div class="cartContentContainer">

        <p>Invoice_No: {{ $order->order_number }}</p>

        <form action="{{ route('updateCart') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pembelian</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $item->barang->namaBarang }}</td>
                            <td>{{ $item->barang->category->name }}</td>
                            <td>
                                <input type="number" name="quantity[{{ $item->id }}]"
                                    value="{{ $item->quantity }}" min="1" class="quantity-input">
                            </td>
                            <td>Rp {{ number_format($item->barang->hargaBarang, 2) }}</td>
                            <td>Rp {{ number_format($item->barang->hargaBarang * $item->quantity, 2) }}</td>

                            <td>
                                <form action="{{ route('removeFromCart', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="updateCartBTN" type="submit" class="update-button">Update</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ route('removeFromCart', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="removeCartBTN" type="submit" class="remove-button">Remove</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        <div class="addressnzipContainer">
            <form action="{{ route('orderUpdate') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <table>
                    <tr>
                        <th>Address</th>
                        <th>Zip</th>
                    </tr>
                    <tr>
                        <td>    
                            <input type="text" id="address" name="alamat_pengiriman"
                                value="{{ old('alamat_pengiriman', $order->alamat_pengiriman ?? 'insert address') }}"
                                class="form-control">
                        </td>
                        <td>
                            <input type="text" id="zipcode" name="kode_pos"
                                value="{{ old('kode_pos', $order->kode_pos ?? '11111') }}"
                                class="form-control">
                        </td>
                        <td>
                            <button type="submit">Update</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        

        
        <tfoot>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold;">Total Harga:</td>
                <td>Rp {{ number_format($totalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </div>

    <div class="cartContainer">

  
        <div class="checkoutContainer">
            
            <div class="left-side">
                <div class="card">
                    <div class="card-line"></div>
                    <div class="buttons"></div>
                </div>
                <div class="post">
                    <div class="post-line"></div>
                    <div class="screen">
                        <div class="dollar">{{ number_format($totalPrice, 2) }}</div>
                    </div>
                    <div class="numbers"></div>
                    <div class="numbers-line2"></div>
                </div>
            </div>
            <div class="right-side">
                <div class="new">Payment</div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
