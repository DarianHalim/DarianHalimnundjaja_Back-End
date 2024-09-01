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
                @foreach ($cartItems as $itemC)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $itemC->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $itemC->barang->namaBarang }}</td>
                        <td>{{ $itemC->barang->category->name }}</td>
                        <td>
                            <!-- Form for updating quantity -->
                            <form action="{{ route('updateCart') }}" method="POST">
                                @csrf
                                <input type="number" name="quantity[{{ $itemC->id }}]"
                                    value="{{ $itemC->quantity }}" min="1" class="quantity-input"
                                    max="{{ $itemC->barang->jumlahBarang }}">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($itemC->barang->hargaBarang, 2) }}</td>
                        <td>Rp {{ number_format($itemC->barang->hargaBarang * $itemC->quantity, 2) }}</td>
                        <td>
                            <!-- Form for deleting item -->
                            <form action="{{ route('removeFromCart', ['id' => $itemC->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="addressnzipContainer">
           @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Your form -->
<form action="{{ route('orderUpdate') }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <div>
        <label for="alamat_pengiriman">Alamat Pengiriman</label>
        <input type="text" name="alamat_pengiriman" id="alamat_pengiriman" value="{{ old('alamat_pengiriman', $order->alamat_pengiriman) }}" required>
        <!-- Error message for address input -->
        @error('alamat_pengiriman')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="kode_pos">Kode Pos</label>
        <input type="number" name="kode_pos" id="kode_pos" value="{{ old('kode_pos', $order->kode_pos) }}" required>
        <!-- Error message for postal code input -->
        @error('kode_pos')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Update</button>
</form>



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
                    <div class="new">Rp {{ number_format($totalPrice, 2) }}</div>
                </div>
            </div>
        </div>

</body>

</html>