<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyleSheet.css') }}">
</head>
<body>
    
    <div class="containerDiv">

        <div class="topHeader">
            <div class="navbarContainer">
                <span><a href="{{ route('getBarang') }}">View</a></span>
                <span><a href="{{ route('getCreatePage') }}">Create</a></span>
                <span><a href="{{ route('getBarang') }}">Leave</a></span>
            </div>
        
        </div>

        <div class="welcomeBanner">
            <h1 class="welcomeHeader">Edit {{ $barang-> namaBarang }}</h1>
        </div>
    
        <div class="contentContainer">
            <form action="{{ route('updateBarang', $barang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="inputContainer">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" name="namaBarang" id="namaBarang" value="{{ $barang->namaBarang }}" required>
                </div>

                <div class="inputContainer">
                    <label for="hargaBarang">Harga Barang</label>
                    <input type="text" name="hargaBarang" id="hargaBarang" value="{{ $barang->hargaBarang }}" required>
                </div>

                <div class="inputContainer">
                    <label for="jumlahBarang">Jumlah Barang</label>
                    <input type="number" name="jumlahBarang" id="jumlahBarang" value="{{ $barang->jumlahBarang }}" required>
                </div>

                <div class="inputContainer">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">
                    
                    @if($barang->image)
                        <img src="{{ asset('storage/images/' . $barang->image) }}" alt="Current Image" style="width: 100px; height: auto;">
                    @endif
                </div>



                <button type="submit">Update</button>
            </form>
        </div>
    </div>
   
</body>
</html>
