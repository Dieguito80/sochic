<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();

        if ($carrito) {
            $productos = $carrito->productos;
        } else {
            $productos = [];
        }

        return view('cliente.carrito', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function agregarAlCarrito($productoId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar productos al carrito');
        }

        // Obtener el producto por su ID
        $producto = Producto::findOrFail($productoId);

        // Obtener el carrito del usuario autenticado (si no existe, se crea uno)
        $carrito = Carrito::firstOrCreate(
            ['user_id' => Auth::id(), 'estado' => 0], // Estado 0 significa carrito activo
            ['fecha_de_compra' => null]
        );

        // Verificar si el producto ya está en el carrito
        $productoEnCarrito = $carrito->productos()->where('producto_id', $productoId)->first();

        if ($productoEnCarrito) {
            // Si el producto ya está en el carrito, aumentar la cantidad y recalcular el subtotal
            $productoEnCarrito->pivot->cantidad++;
            $productoEnCarrito->pivot->subtotal = $productoEnCarrito->pivot->cantidad * $producto->precio_minorista;
            $productoEnCarrito->pivot->save();
        } else {
            // Si el producto no está en el carrito, agregarlo con cantidad 1 y calcular el subtotal
            $carrito->productos()->attach($productoId, [
                'cantidad' => 1,
                'subtotal' => $producto->precio_minorista
            ]);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito');
    }

    

    /**
     * Mostrar los productos del carrito.
     */
   
}
