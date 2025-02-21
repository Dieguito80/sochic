@extends('layouts.app')

@section('titulo')
    Pagina principal
@endsection

@section('contenido')

<header class="bg-white shadow-sm relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Nuestros Productos</h1>
        <div class="flex items-center">
            <form action="{{ route('productos.categoria') }}" method="GET" class="relative mr-4">
                <input type="text" name="search" placeholder="Buscar productos..." class="pl-10 pr-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="absolute right-0 top-0 mt-2 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
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
            <div class="group relative bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="aspect-square overflow-hidden relative group">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                         alt="{{ $producto->nombre }}" 
                         class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
                </div>
                
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $producto->nombre }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $producto->descripcion }}</p>
                    
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
                            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</main>

@endsection