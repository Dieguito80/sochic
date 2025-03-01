@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Administrar Productos</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

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
                    <th class="py-2 px-4">Categoría</th>
                    <th class="py-2 px-4">Precio Minorista</th>
                    <th class="py-2 px-4">Precio Mayorista</th>
                    <th class="py-2 px-4">Cantidad Stock</th>
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
                            @else
                                <span class="text-green-500">Disponible</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">
                            <div class="flex gap-2">
                                <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg btn-eliminar"
                                        data-producto-id="{{ $producto->id }}">
                                            Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const botonesEliminar = document.querySelectorAll('.btn-eliminar');
        
                botonesEliminar.forEach(boton => {
                    boton.addEventListener('click', function() {
                        const productoId = this.dataset.productoId;
        
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: '¿Deseas eliminar este producto?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Enviar formulario de eliminación
                                const form = document.createElement('form');
                                form.action = `/productos/${productoId}`; // Ajusta la URL según tu ruta
                                form.method = 'POST';
                                form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
@endsection
