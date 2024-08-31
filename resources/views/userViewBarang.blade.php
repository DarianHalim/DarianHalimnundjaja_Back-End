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

        <div class="SearchBarContainer">
            <input type="text" placeholder="Search" class="searchBar">
            <button class="searchButton">Search</button>
        </div>

        <div class="viewContentContainer">


            @foreach ($barang as $item)
                <div class="card">
                    <div class="card-details">
                        <p class="text-title">
                            @if ($item->image)
                            <img src="{{ asset('storage/images/' . $item->image) }}"
                                alt="Image for {{ $item->namaBarang }}" style="width: 130px; height: auto;">
                        @else
                            No image
                        @endif
                        </p>
                        <p class="text-title">{{ $item->namaBarang }}</p>
                        <p class="text-title">Harga: {{ $item->hargaBarang }}</p>
                        <p class="text-title">Jumlah: {{ $item->jumlahBarang }}</p>
                        <p class="text-title">Kategory:{{ $item->category->name }}</p>

                        
                    </div>
                    <form action="{{ route('cartAdd') }}" method="POST">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $item->id }}">
                        <button class="card-button">Add To Cart</button>
                    </form>
                   
                </div>
            @endforeach



        </div>
    </div>



</body>

</html>
