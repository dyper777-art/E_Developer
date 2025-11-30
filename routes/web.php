<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Auth\LoginController;

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


Route::post('/register', [RegisterController::class, 'register'])->name('register');


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/service', 'index')->name('service');
});

Route::get('/about', function () {
    return view('frontend.about.index');
})->name('about');

// Add service to cart by ID
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::prefix('checkout')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/generateQr', [CheckoutController::class, 'generateQr'])->name('checkout.generateQr');
    Route::post('/checkPayment', [CheckoutController::class, 'checkPayment'])->name('checkout.checkPayment');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/process', [CheckoutController::class, 'manualPayment'])->name('checkout.manualPayment');

});

Route::delete('/cart-items/{id}', [CartController::class, 'destroy'])->name('cart-items.destroy');


