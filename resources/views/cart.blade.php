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
                                <button class="updateCartBTN" type="submit" class="update-button">Update</button>
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


    </div>



    <div class="cartContainer">

        <tfoot>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold;">Total Harga:</td>
                <td>Rp {{ number_format($totalPrice, 2) }}</td>
            </tr>
        </tfoot>

        <button class="no-print" onclick="window.print()">Print Invoice</button>


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

</body>

</html>
