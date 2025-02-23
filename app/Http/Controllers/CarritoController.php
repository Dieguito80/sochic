<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar el carrito del usuario autenticado
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();
        
        // Si no hay carrito, asignamos un array vacío para productos
        if ($carrito) {
            $productos = $carrito->productos;
        } else {
            $productos = [];
        }
    
        // Inicializamos el total
        $total = 0;
    
        // Calculamos el total basado en los productos
        foreach ($productos as $producto) {
            $cantidad = $producto->pivot->cantidad;
    
            // Determinamos el precio (mayorista o minorista)
            $precio = ($cantidad >= 5 && $producto->precio_mayorista)
                      ? $producto->precio_mayorista
                      : $producto->precio_minorista;
    
            // Sumamos al total
            $total += $precio * $cantidad;
        }
    
        // Pasamos los productos y el total a la vista
        return view('cliente.carrito', compact('productos', 'total'));
    }

// Controlador
public function verHistorial()
{
    $carritos = Carrito::where('user_id', auth()->id())
        ->orderBy('fecha_de_compra', 'desc')
        ->with('productos') // Cargar la relación de productos
        ->get();
    return view('cliente.historialPedidos', compact('carritos'));
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
    public function destroy($productoId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        // Obtener el carrito activo del usuario autenticado
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();

        if (!$carrito) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró un carrito activo.');
        }

        // Verificar si el producto está en el carrito
        $productoEnCarrito = $carrito->productos()->where('producto_id', $productoId)->first();

        if ($productoEnCarrito) {
            // Eliminar el producto del carrito
            $carrito->productos()->detach($productoId);

            return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->route('carrito.index')->with('error', 'El producto no se encontró en el carrito.');
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

    public function carrito()
    {
        $productos = auth()->user()->carrito; // O la lógica para obtener los productos en el carrito
    
        $total = 0;
    
        foreach ($productos as $producto) {
            $cantidad = $producto->pivot->cantidad;
    
            // Valida si usar precio mayorista o minorista
            $precio = ($cantidad >= 5 && $producto->precio_mayorista) 
                      ? $producto->precio_mayorista 
                      : $producto->precio_minorista;
    
            $total += $precio * $cantidad;
        }
    
        // Asegúrate de enviar $total a la vista
        return view('carrito.index', compact('productos', 'total'));
    }
    

    public function actualizarCantidad(Request $request, $productoId)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }
    
        // Validar la cantidad ingresada
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);
    
        // Obtener el carrito activo del usuario
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();
    
        if (!$carrito) {
            return redirect()->route('carrito.index')->with('error', 'No se encontró un carrito activo.');
        }
    
        // Verificar si el producto está en el carrito
        $productoEnCarrito = $carrito->productos()->where('producto_id', $productoId)->first();
    
        if ($productoEnCarrito) {
            // Actualizar la cantidad y el subtotal
            $cantidad = $request->input('cantidad');
    
            // Determinar si se aplica precio mayorista o minorista
            $precio = ($cantidad >= 5 && $productoEnCarrito->precio_mayorista)
                ? $productoEnCarrito->precio_mayorista
                : $productoEnCarrito->precio_minorista;
    
            $productoEnCarrito->pivot->cantidad = $cantidad;
            $productoEnCarrito->pivot->subtotal = $cantidad * $precio;
            $productoEnCarrito->pivot->save();
    
            return redirect()->route('carrito.index')->with('success', 'Cantidad actualizada.');
        }
    
        return redirect()->route('carrito.index')->with('error', 'El producto no se encontró en el carrito.');
    }

    public function finalizarPedido(Request $request, $carritoId)
    {
        $carrito = Carrito::findOrFail($carritoId);

        // ... (lógica para procesar el pago y validar la información) ...

        $carrito->fecha_de_compra = Carbon::now();
        $carrito->estado = 1; // 1 significa "completado" (ajusta según tus estados)
        $carrito->save();

        // ... (otras acciones, como enviar correos electrónicos) ...

        return redirect()->route('cliente.historialPedidos')->with('success', 'Pedido finalizado con éxito.');
    }
    
    

    /**
     * Mostrar los productos del carrito.
     */
   
}
