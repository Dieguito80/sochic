<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        // dd($productos);
        // Pasar los datos a la vista
        return view('admin.productos.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_minorista' => 'required|numeric|min:0',
            'precio_mayorista' => 'required|numeric|min:0',
            'cantidad_stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Crear producto
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio_minorista = $request->precio_minorista;
        $producto->precio_mayorista = $request->precio_mayorista;
        $producto->cantidad_stock = $request->cantidad_stock;
        $producto->descripcion = $request->descripcion;
    
        // Guardar imagen si se sube una
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('images', 'public');
            $producto->imagen = $path;
        }
    
        $producto->save();
    
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }
    

   
    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    public function show(string $id)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);
    
        // Retornar la vista con el producto específico
        return view('cliente.show', compact('producto'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        // Retornar la vista de edición con los datos del producto
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_minorista' => 'required|numeric',
            'precio_mayorista' => 'required|numeric',
            'cantidad_stock' => 'required|integer',
            'imagen' => 'image|mimes:jpeg,png,jpg|max:2048',
            'descripcion' => 'required|string',
        ]);

        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del producto
        $producto->nombre = $request->nombre;
        $producto->precio_minorista = $request->precio_minorista;
        $producto->precio_mayorista = $request->precio_mayorista;
        $producto->cantidad_stock = $request->cantidad_stock;
        $producto->descripcion = strip_tags($request->descripcion);

        // Actualizar la imagen si se sube una nueva
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->imagen->store('productos', 'public');
            $producto->imagen = $imagenPath;
        }

        // Guardar los cambios
        $producto->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Eliminar el producto
        $producto->delete();

        // Redireccionar con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }



    public function showCliente()
    {
        // Obtener los productos que pertenecen a la categoría especificada
        // $productos = Producto::where('categoria_id', $id)->get();
        $productos = Producto::all();
        // Retornar la vista con los productos filtrados
        return view('cliente.index', compact('productos'));
    }

    public function categoria(Request $request)
    {
        $search = $request->input('search');
        $productos = Producto::query();

        if ($search) {
            $productos->where('nombre', 'LIKE', "%{$search}%");
        }

        $productos = $productos->get();

        return view('cliente.productos', compact('productos'));
    }
}
