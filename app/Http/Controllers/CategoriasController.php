<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Mostrar todas las categorías.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Mostrar el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Almacenar una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        // Crear la categoría
        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Mostrar el formulario para editar una categoría específica.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar la categoría en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validación del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
        ]);

        // Buscar y actualizar la categoría
        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Eliminar una categoría de la base de datos.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
