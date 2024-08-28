<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route for the home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route for the login page
Route::get('/login', function () {
    return view('loginPage');
})->name('login');

// Route for the sign-up page
Route::get('/signUp', function () {
    return view('signUpPage');
})->name('signup');

// Route for the admin login page
Route::get('/adminLogIn', function () {
    return view('adminLogIn');
})->name('adminLogIn');

// Route to display the form to create a new item
Route::get('/adminCreate', [BarangController::class, 'getCreatePage'])->name('getCreatePage');

// Route to handle the form submission for creating a new item
Route::post('/createBarang', [BarangController::class, 'createBarang'])->name('createBarang');

// Route to view all items
Route::get('/viewBarangPage', [BarangController::class, 'getBarang'])->name('getBarang');