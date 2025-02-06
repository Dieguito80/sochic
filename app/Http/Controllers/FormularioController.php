<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        return view('cliente.formulario'); // Vista del formulario
    }

    public function store(Request $request)
    {
        // Lógica para manejar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'altura' => 'required|numeric',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'comprobante' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ejemplo: guardar comprobante
        if ($request->hasFile('comprobante')) {
            $path = $request->file('comprobante')->store('comprobantes', 'public');
        }

        // Redirige o muestra mensaje de éxito
        return redirect()->route('formulario')->with('success', 'Formulario enviado correctamente');
    }
}
