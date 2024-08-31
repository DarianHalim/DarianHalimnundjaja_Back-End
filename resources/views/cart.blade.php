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
                <span><a href="{{ route('home') }}">Leave</a></span>
            </div>
        </div>

        <div class="cartContentContainer">



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
                                <div class="dollar">$</div>
                            </div>
                            <div class="numbers"></div>
                            <div class="numbers-line2"></div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="new">Payment</div>
                    </div>
                </div>

            </div>
</body>

</html>
