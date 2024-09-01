<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalog Menu</title>
    <link rel="stylesheet" href="{{ asset('css/userStyleSheet.css') }}">
</head>

<body>

    <div class="containerDiv">

        <div class="topHeader">
            <div class="navbarContainer">
                <span><a href="{{ route('getCart') }}">To Cart</a></span>
                <span><a href="{{ route('home') }}">Leave</a></span>
            </div>
        </div>


        <div class="viewContentContainer">

            @foreach ($barang as $item)
                <div class="card">
                    <div class="card-details">
                        <p class="text-title">
                            @if ($item->image)
                                <img src="{{ asset('storage/images/' . $item->image) }}"
                                     alt="Image for {{ $item->namaBarang }}" style="width: 130px; height: auto; border-radius: 0.5rem">
                            @else
                                No image
                            @endif
                        </p>
                        <p class="text-title">{{ $item->namaBarang }}</p>
                        <p class="text-title">Harga: {{ number_format($item->hargaBarang, 2) }}</p>
                        <p class="text-title">Jumlah Barang: {{ $item->jumlahBarang }}</p>
                        <p class="text-title">Kategori: {{ $item->category->name }}</p>
                    </div>
                    @if ($item->jumlahBarang != 0)
                        <form action="{{ route('cartAdd') }}" method="POST">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $item->id }}">
                            <button class="card-button">Add To Cart</button>
                        </form>
                    @else
                        <button class="card-button">NO STOCK</button>
                    @endif
                </div>
            @endforeach

        </div>
    </div>

</body>

</html>
