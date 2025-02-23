@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Administrar Productos</h1>

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Agregar Producto</a>
            <form action="{{ route('productos.index') }}" method="GET" class="flex justify-end">
                <div class="flex items-center">
                    <select name="categoria_id" class="border rounded-lg px-3 py-2 mr-2">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}" class="border rounded-lg px-3 py-2 mr-2">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Buscar</button>
                </div>
            </form>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg mt-4 shadow-md">
            <thead>
                <tr class="text-left bg-gray-100">
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Categoria</th>
                    <th class="py-2 px-4">Precio Minorista</th>
                    <th class="py-2 px-4">Precio Mayorista</th>
                    <th class="py-2 px-4">Cantidad_stock</th>
                    <th class="py-2 px-4">Descripción</th>
                    <th class="py-2 px-4">Imagen</th>
                    <th class="py-2 px-4">Estado</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $producto->id }}</td>
                        <td class="py-2 px-4">{{ $producto->nombre }}</td>
                        <td class="py-2 px-4">{{ $producto->categoria->nombre }}</td>
                        <td class="py-2 px-4">{{ $producto->precio_minorista }}</td>
                        <td class="py-2 px-4">{{ $producto->precio_mayorista }}</td>
                        <td class="py-2 px-4">{{ $producto->cantidad_stock }}</td>
                        <td class="py-2 px-4">{{ $producto->descripcion }}</td>
                        <td class="py-2 px-4">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-10 h-10 object-cover rounded-full">
                            @else
                                <span class="text-gray-400">Sin imagen</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">
                            @if($producto->cantidad_stock <= 0)
                                <span class="text-red-500 font-bold">Publicación pausada</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection