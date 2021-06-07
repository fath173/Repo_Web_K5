<?php

use App\Http\Livewire\Frontend\Carts\Cart;
use App\Http\Livewire\Frontend\Login\Login;
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

Route::get('/', function () {
    return view('livewire.frontend.index');
});

Auth::routes();

Route::get('/cart', Cart::class);
Route::get('/loginn', Login::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
