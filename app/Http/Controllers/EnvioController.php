<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\envio;
use Auth;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.formulario'); // Vista del formulario
    }

    public function store(Request $request)
    { 
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();
        $carritoId = $carrito->id;
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:formularios',
            'telefono' => 'required|string|max:15',
            'comprobante' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Guardar el archivo en la carpeta "storage/app/public/comprobantes"
        $path = $request->file('comprobante')->store('comprobantes', 'public');

        // Guardar los datos en la base de datos
        envio::create([
            'nombre' => $validated['nombre'],
            'carrito_id' => $carritoId,
            'apellido' => $validated['apellido'],
            'direccion' => $validated['direccion'],
            'correo' => $validated['correo'],
            'telefono' => $validated['telefono'],
            'comprobante_path' => $path,
        ]);

        $categoria = Carrito::findOrFail($carritoId);
        $categoria->update([
            'estado' => 1,
        ]);

        return redirect()->route('carrito.index')->with('success', 'Formulario enviado correctamente');
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
}
