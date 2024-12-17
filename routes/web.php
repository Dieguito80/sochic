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


//registro
Route::get('/register', [RegisterController::class, 'index'])->name('register'); // para visitar en sitio web
Route::post('/register', [RegisterController::class, 'store']); //envia datos al servidor formulario de registro

//login
route::get('/login', [LoginController::class,'index'])->name('login');
route::post('/login', [LoginController::class,'store']);
route::post('/logout', [LogoutController::class,'store'])->name('logout');



//vistas admin

// Listar productos
Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');

// Mostrar formulario para crear producto
Route::get('/productos/create', [ProductosController::class, 'create'])->name('productos.create');

// Almacenar un nuevo producto
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');

// Mostrar formulario para editar producto
Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');

// Actualizar un producto
Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');

// Eliminar un producto
Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');





route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

//vistas cliente

Route::get('/', [ProductosController::class, 'showCliente'])->name('productos.categoria');

route::get('/{user:username}', [PostController::class,'index'])->name('Posts.index');





