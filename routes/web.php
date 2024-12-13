<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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
    return view('principal');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register'); // para visitar en sitio web
Route::post('/register', [RegisterController::class, 'store']); //envia datos al servidor formulario de registro


route::get('/login', [LoginController::class,'index'])->name('login');
route::post('/login', [LoginController::class,'store']);
route::post('/logout', [LogoutController::class,'store'])->name('logout');

route::get('/{user:username}', [PostController::class,'index'])->name('Posts.index');
