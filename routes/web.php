<?php
use App\Http\Controllers\BarangController;
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
});

require __DIR__.'/auth.php';


// Route for the home page
Route::get('/', function () {
    return view('welcome');
})->name('home');



// Route for the sign-up page
Route::get('/signUp', function () {
    return view('signUpPage');
})->name('signup');


// Route  display  form  create a new item
Route::get('/adminCreate', [BarangController::class, 'getCreatePage'])->name('getCreatePage');

// Route    form submission  creating a new item
Route::post('/createBarang', [BarangController::class, 'createBarang'])->name('createBarang');

// Route  view all items
Route::get('/viewBarangPage', [BarangController::class, 'getBarang'])->name('getBarang');

// Route to display form for updating an item
Route::get('/editBarang/{id}', [BarangController::class, 'getBarangById'])->name('editBarang');

// Route for updating an item in the database
Route::patch('/editBarang/{id}', [BarangController::class, 'updateBarang'])->name('updateBarang');

//Delete
Route::delete('/delete-barang/{id}', [BarangController::class,'deleteBarang'])->name('deleteBarang');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
