<?php

namespace App\Http\Controllers;
use App\Models\Producto;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_minorista' => 'required|numeric', // Precio para el público
            'precio_mayorista' => 'required|numeric', // Precio para mayoristas
            'cantidad_stock' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:2048',
            'descripcion' => 'required|string',
        ]);
    
        $imagenPath = $request->imagen->store('productos', 'public');
    
        Producto::create([
            'nombre' => $request->nombre,
            'precio_minorista' => $request->precio_minorista,
            'precio_mayorista' => $request->precio_mayorista,
            'cantidad_stock' => $request->cantidad_stock,
            'imagen' => $imagenPath,
            'descripcion' => strip_tags($request->descripcion),
        ]);
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }
   
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    public function show()
    {
        // Obtener los productos que pertenecen a la categoría especificada
        // $productos = Producto::where('categoria_id', $id)->get();
        $productos = Producto::all();
        // Retornar la vista con los productos filtrados
        return view('cliente.index', compact('productos'));
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
}
