<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Barang</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyleSheet.css') }}">
</head>

<body>

    <div class="container">
        <div class="topContainer">
            <div class="navbarContainer">
                <div class="navbarContainer">
                    <span><a href="{{ route('getBarang') }}">View</a></span>
                    <span><a href="{{ route('getCreatePage') }}">Create</a></span>
                    <span><a href="{{ route('home') }}">Leave</a></span>
                </div>
            </div>

            <h1 class="welcomeHeader">Buat Barang Baru</h1>


            <div class="contentContainer">
                <form action="{{ route('createBarang') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="inputContainer">
                        <label for="namaBarang">Nama Barang</label>
                        <input type="text" name="namaBarang" id="namaBarang" required>
                    </div>

                    <div class="inputContainer">
                        <label for="hargaBarang">Harga Barang</label>
                        <input type="text" name="hargaBarang" id="hargaBarang" required>
                    </div>

                    <div class="inputContainer">
                        <label for="jumlahBarang">Jumlah Barang</label>
                        <input type="number" name="jumlahBarang" id="jumlahBarang" required>
                    </div>

                    <div class="inputContainer">
                        <label for="imageBarang">Foto Barang</label>
                        <input  id="imageBarang" type="file" name="image">
                    </div>

                    <div class="inputContainer">
                        <label for="category_id">Pilih Category</label>
                        <select name="category_id" id="category_id" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                        
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>


    </div>




</body>

</html>
