<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Menu</title>
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

        <div class="viewContentContainer">


            <div class="welcomeBanner">
                <h2 class="viewHeader">Daftar Barang</h2>
            </div>

            <div class="SearchBarContainer">
                <input type="text" placeholder="Search" class="searchBar">
                <button class="searchButton">Search</button>
            </div>

            <div class="tableContainer">

                <thead>

                    <table class="viewTable">

                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Options</th>
                        </tr>

                </thead>

                <tbody>

                    @foreach ($barang as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->idBarang }}</td>
                            <td>{{ $item->namaBarang }}</td>
                            <td>{{ $item->hargaBarang }}</td>
                            <td>{{ $item->jumlahBarang }}</td>
                            <td class="optionsButtonContainer">
                                <a href="{{ route('editBarang', $item->id) }}">
                                    <button type="button" class="editButton">Edit</button>
                                </a>
                                
                
                                <button class="deleteButton" type="submit">Delete</button>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

                </table>
            </div>

        </div>
    </div>



</body>

</html>
