<?php

namespace App\Http\Controllers;

use App\Models\Carrito; // Importa el modelo Carrito
use App\Models\User;    // Importa el modelo User si es necesario

use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los carritos con los datos del usuario asociado
        $pedidos = Carrito::with('user')->get();
    
        // Retornar a la vista con los datos
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
