<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/loginStyleSheet.css')}}">
</head>
<body>

    <div class="welcomeHeaders">
        <h1>Toko Kelontong Pak Raja</h1>
       <p>Jika  memiliki akun mohon <a href="{{ route('login') }}">LogIn</a> </p>
    </div>

    <div class="formContainer">
        <form action="">
    
            <div class="signInContainer">
    
                <h1>Register</h1>
    
                <div class="InputContainers">
                    <label for="name">Name</label>
                    <input type="text">
                </div>
    
                <div class="InputContainers">
                    <label for="email">Email</label>
                    <input type="email">
                </div>
            
                <div class="InputContainers">
                    <label for="password">Password</label>
                    <input type="password">
                </div>
    
                <div class="InputContainers">
                    <label for="nohp">Nomor Hape</label>
                    <input type="text">
                </div>
    
                <button type="submit">Register</button>
        </form> 
    </div>
    
</body>
</html>