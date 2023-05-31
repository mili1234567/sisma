<?php

use App\Http\Livewire\PosController;
use App\Http\Livewire\ProductController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', ProductController::class);
    Route::get('productos', ProductController::class);
    Route::get('catalogo', PosController::class);
    Route::get('users', UsersController::class);
    Route::get('roles', RolesController::class);
   

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index'])->name('home2');
});
// route::redirect('/','productos');



