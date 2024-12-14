<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductosController;

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

/* Route::get('/', function () {
    return view('cliente.index');
}); */



Route::get('/register', [RegisterController::class, 'index'])->name('register'); // para visitar en sitio web
Route::post('/register', [RegisterController::class, 'store']); //envia datos al servidor formulario de registro


route::get('/login', [LoginController::class,'index'])->name('login');
route::post('/login', [LoginController::class,'store']);
route::post('/logout', [LogoutController::class,'store'])->name('logout');

Route::get('/', [ProductosController::class, 'show'])->name('productos.categoria');
Route::post('/ProductosEdit', [ProductosController::class, 'edit'])->name('productos.edit');
Route::post('/', [ProductosController::class, 'show'])->name('productos.destroy');

route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

route::get('/{user:username}', [PostController::class,'index'])->name('Posts.index');



