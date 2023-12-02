<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group( function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/create', [HomeController::class, 'create'])->name('create');
    Route::post('/store', [HomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('delete');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/pie', [HomeController::class, 'pie'])->name('pie');
    Route::get('/column', [HomeController::class, 'column'])->name('column');
});

require __DIR__.'/auth.php';
