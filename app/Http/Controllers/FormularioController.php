<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        return view('cliente.formulario'); // Vista del formulario
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'altura' => 'required|numeric',
            'correo' => 'required|email|max:255|unique:formularios',
            'telefono' => 'required|string|max:15',
            'comprobante' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Guardar el archivo en la carpeta "storage/app/public/comprobantes"
        $path = $request->file('comprobante')->store('comprobantes', 'public');

        // Guardar los datos en la base de datos
        Formulario::create([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'direccion' => $validated['direccion'],
            'altura' => $validated['altura'],
            'correo' => $validated['correo'],
            'telefono' => $validated['telefono'],
            'comprobante_path' => $path,
        ]);

        return redirect()->route('formulario.index')->with('success', 'Formulario enviado correctamente');
    }
}

