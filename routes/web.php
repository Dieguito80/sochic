<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\FormularioController;


/* Route::get('/', function () {
    return view('cliente.index');
}); */


// Registro
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



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








//rutas para gestion de pedidos
/* Route::get('/gestion', [GestionController::class, 'index'])->name('gestion.index');
Route::get('/gestion/create', [GestionController::class, 'create'])->name('gestion.create');
Route::post('/gestion', [GestionController::class, 'store'])->name('gestion.store');
Route::get('/gestion/{id}/edit', [GestionController::class, 'edit'])->name('gestion.edit');
Route::put('/gestion/{id}', [GestionController::class, 'update'])->name('gestion.update');
Route::delete('/gestion/{id}', [GestionController::class, 'destroy'])->name('gestion.destroy'); */
Route::resource('gestion', GestionController::class);
// Route::post('/gestionCambioEstado', [GestionController::class, 'cambiarEstado'])->name('gestion.cambioEstado');
Route::put('/gestionCambioEstado/{id}', [GestionController::class, 'cambiarEstado'])->name('gestion.cambioEstado');



// Rutas para Categorías
Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');


// Ruta para agregar un producto al carrito
Route::post('/carrito/{productoId}/agregar', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
route::get('/historial', [CarritoController::class, 'verHistorial'])->name('carritos.historial');
route::get('/verhistorial', [CarritoController::class, 'verCarritoHistorial'])->name('carritos.ver');


route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Rutas para gestión de usuarios
Route::resource('usuarios', \App\Http\Controllers\UserController::class);

Route::resource('usuarios', \App\Http\Controllers\UserController::class)->middleware('auth');



/* Route::get('/envio', [EnvioController::class, 'index'])->name('envio.index');
Route::post('/envio', [EnvioController::class, 'store'])->name('envio.store');
Route::post('/envio', [EnvioController::class, 'store'])->name('envio.store'); */
Route::resource('envio', EnvioController::class);
// Route::get('/formEnvio/{id}', [EnvioController::class, 'index'])->name('formEnvio.index');

//vistas cliente

route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');

Route::patch('/carrito/{producto}', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');

Route::delete('/carrito/eliminar/{producto}', [CarritoController::class, 'destroy'])->name('carrito.eliminar');

Route::post('/carrito/{id}/finalizar', [CarritoController::class, 'finalizarPedido'])->name('carrito.finalizar');





Route::get('/', [ProductosController::class, 'showCliente'])->name('productos.categoria');

Route::get('/posts', [PostController::class, 'index'])->name('Posts.index');







