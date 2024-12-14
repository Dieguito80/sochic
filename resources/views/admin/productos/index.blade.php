@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Administrar Productos</h1>
        
        <!-- Botón para agregar un nuevo producto -->
        {{-- <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4">Agregar Producto</a> --}}
        
        <!-- Tabla de productos -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="text-left bg-gray-100">
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Precio</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $producto->id }}</td>
                        <td class="py-2 px-4">{{ $producto->nombre }}</td>
                        <td class="py-2 px-4">{{ $producto->precio }}</td>
                        <td class="py-2 px-4">
                            <!-- Botón de Editar -->
                            <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Editar</a>
                            
                            <!-- Botón de Eliminar -->
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
