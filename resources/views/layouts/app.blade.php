<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/loginStyleSheet.css')}}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: #F44336;">
            @include('layouts.navigation')

            <!-- Page Heading -->
          

            <!-- Page Content -->
            <main>
                <div class="mainHeader">
                    <h1>Toko Kelontong Pak Raja</h1>
                    <h2>Harga Termurah Kualitas Terbaik</h2>
                    <div class="logoTokoContainer">
                        <img class="logoToko" src="https://png.pngtree.com/png-clipart/20230124/ourmid/pngtree-illustration-of-a-roadside-angkringan-stall-cart-png-image_6564707.png" alt="">
                    </div>
                   <h1>Silakan Melihat Barang Dagangan Kami</h1>
                </div>

                
         

            </main>
        </div>
    </body>
</html>
