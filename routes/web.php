<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Show Cart
    Route::get('/cart',[cartController::class,'getCart'])->name('getCart');
    //add to cart
    Route::post('/cart/add', [cartController::class, 'addToCart'])->name('cartAdd');
    
// Route for updating cart quantities
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('updateCart');

// Route for removing items from the cart
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

Route::get('/order/{order_number}', [cartController::class, 'show'])->name('order.show');
Route::post('/order/update', [cartController::class, 'update'])->name('orderUpdate');


});

require __DIR__ . '/auth.php';


// Route for the home page
Route::get('/', function () {
    return redirect()->route('register');
})->name('home');



// Route for the sign-up page
Route::get('/signUp', function () {
    return view('signUpPage');
})->name('signup');





Route::get('/userView', [BarangController::class, 'getKatalog'])->name('getKatalog');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('admin')->group(function () {
    // Route to display form to create a new item
    Route::get('/adminCreate', [BarangController::class, 'getCreatePage'])->name('getCreatePage');

    // Route to view all items
Route::get('/viewBarangPage', [BarangController::class, 'getBarang'])->name('getBarang');

    // Route for form submission to create a new item
    Route::post('/createBarang', [BarangController::class, 'createBarang'])->name('createBarang');


    // Route to display form for updating an item
    Route::get('/editBarang/{id}', [BarangController::class, 'getBarangById'])->name('editBarang');

    // Route for updating an item in the database
    Route::patch('/editBarang/{id}', [BarangController::class, 'updateBarang'])->name('updateBarang');

    // Route for deleting an item
    Route::delete('/delete-barang/{id}', [BarangController::class, 'deleteBarang'])->name('deleteBarang');
});