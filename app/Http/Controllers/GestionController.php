<?php

namespace App\Http\Controllers;

use App\Models\Carrito; // Importa el modelo Carrito
use App\Models\DetalleCarrito;
use App\Models\envio;
use App\Models\User;    // Importa el modelo User si es necesario

use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pedidos = Carrito::query()
            ->with(['envio', 'user']); // Asegúrate de que 'user' esté aquí si lo necesitas
    
        if ($request->has('search') && $request->search != '') {
            $pedidos->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }
    
        $pedidos = $pedidos->get();
    
        return view('admin.gestion.index', compact('pedidos'));
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
    public function show(string $carritoId)
    {
    // Obtener el carrito con productos y detalles adicionales
    $carrito = DetalleCarrito::where('carrito_id', $carritoId)->with('producto')->get();

    // Obtener los detalles del producto para cada item en el carrito
    $carrito->each(function ($detalle) {
        $detalle->producto = $detalle->producto()->first();
    });
    // Obtener el estado del carrito
    $estadoCarrito = Carrito::where('id', $carritoId)->value('estado');


        // Buscar la información del envío usando el carrito_id
        $envio = envio::where('carrito_id', $carritoId)->first();

        return view('admin.gestion.detalles', compact('carrito', 'envio', 'estadoCarrito', 'carritoId'));
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

    public function cambiarEstado(Request $request, $id)
    {
        $carrito = Carrito::findOrFail($id);
        $carrito->estado = $request->estado;
        $carrito->save();
    
        return back()->with('success', 'Estado actualizado correctamente');
    }
}
