<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>logIn</title>
    <link rel="stylesheet" href="{{ asset('css/loginStyleSheet.css')}}">
</head>
<body>
    <div class="welcomeHeaders">
        <h1>Toko Kelontong Pak Raja Admin</h1>

    </div>


    <div class="formContainer">
        <form action="">

            <div class="signInContainer">

                <h1>Log In</h1>

                <div class="InputContainers">
                    <label for="name">Nama</label>
                    <input type="text" required>
                </div>
            
                <div class="InputContainers">
                    <label for="password">Password</label>
                    <input type="password">
                </div>


                <button type="submit">Log In</button>
        </form> 
    </div>




</body>
</html>