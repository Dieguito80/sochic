@extends('layouts.app')

@section('titulo')
    Pagina principal
@endsection

@section('contenido')

    <header class="bg-white shadow-sm relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2 sm:mb-0">Nuestros Productos</h1>
            <div class="flex flex-col sm:flex-row items-center w-full sm:w-auto">
                <form action="{{ route('productos.categoria') }}" method="GET" class="flex items-center w-full sm:w-auto mb-2 sm:mb-0 sm:mr-4">
                    <select name="categoria_id" class="border rounded-lg px-3 py-2 mr-2 w-full sm:w-auto mb-2 sm:mb-0">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}" class="border rounded-lg px-3 py-2 mr-2 w-full sm:w-auto mb-2 sm:mb-0">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full sm:w-auto">Buscar</button>
                </form>
                <a href="{{ route('carrito.index') }}" class="hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 hover:text-gray-900 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h11l-1.5-7M10 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($productos as $producto)
                    <div class="group relative bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl p-2"><div class="aspect-square overflow-hidden relative group">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $producto->nombre }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mb-4 descripcion-producto" data-descripcion="{{ $producto->descripcion }}">{{ $producto->descripcion }}</p>
                            <div class="space-y-2">
                                <div class="flex items-center text-green-600">
                                    <span class="font-medium mr-2">Precio</span>
                                    <span class="font-medium">{{ number_format($producto->precio_minorista, 2) }}</span>
                                </div>
                                <div class="flex items-center text-blue-600 mr-2">
                                    <span class="font-medium mr-2">Mayorista</span>
                                    <span class="font-medium">{{ number_format($producto->precio_mayorista, 2) }}</span>
                                </div>
                            </div>
                            @if ($producto->cantidad_stock <= 0)
                                <div class="mt-2 text-red-600 text-lg">
                                    Publicación pausada.
                                </div>
                            @else
                                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-full">Agregar al carrito</button></form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const descripciones = document.querySelectorAll('.descripcion-producto');

                descripciones.forEach(descripcion => {
                    descripcion.addEventListener('click', function() {
                        const descripcionCompleta = this.dataset.descripcion;

                        Swal.fire({
                            title: 'Descripción del Producto',
                            text: descripcionCompleta,
                            icon: 'info',
                            confirmButtonText: 'Cerrar'
                        });
                    });
                });
            });
        </script>

@endsection