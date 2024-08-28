<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Menu</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyleSheet.css')}}">
</head>
<body>

    <div class="containerDiv">

        <div class="topHeader">
            <div class="navbarContainer">
                <span>View</span>
                <span>Create</span>
                <span>Leave</span>
            </div>
        
            <div class="welcomeBanner">
                <h1 class="welcomeHeader">Daftar Barang</h1>
            </div>
        
        </div>
    
        <div class="viewContentContainer">

            <div class="SearchBarContainer"> 
                <input type="text" placeholder="Search" class="searchBar">
                <button class="searchButton" >Search</button>
            </div>

            <div class="tableContainer">
                <thead>
                <table class="viewTable">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                

                </table>
            </div>

        </div>
    </div>
    
   
    
</body>
</html>