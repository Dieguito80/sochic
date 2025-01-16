@extends('layouts.app')


@section('titulo')

    Pagina principal

@endsection

@section('contenido')

<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-900">Nuestros Productos</h1>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Products will be inserted here by JavaScript -->
    </div>
</main>

<!-- Product Card Template -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($productos as $producto)
        <div class="group relative bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl">
            <div class="aspect-square overflow-hidden">
                <img 
                    src="{{ $producto->imagen }}" 
                    alt="{{ $producto->nombre }}" 
                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $producto->nombre }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $producto->descripcion }}</p>
                
                <div class="space-y-2">
                    <div class="flex items-center text-green-600">
                        <i class="fas fa-dollar-sign w-4 h-4 mr-2"></i>
                        <span class="font-medium">{{ number_format($producto->precio_minorista, 2) }}</span>
                    </div>
                    <div class="flex items-center text-blue-600">
                        <i class="fas fa-box w-4 h-4 mr-2"></i>
                        <span class="font-medium">{{ number_format($producto->precio_mayorista, 2) }}</span>
                    </div>
                </div>
                
                {{-- <button 
                    class="mt-4 w-full bg-black text-white py-2 px-4 rounded-md flex items-center justify-center gap-2 hover:bg-gray-800 transition-colors"
                    onclick="addToCart({{ $producto->id }})">
                    <i class="fas fa-shopping-cart w-4 h-4"></i>
                    Add to Cart
                </button> --}}
                <a href="{{ route('carrito.index') }}" class="btn btn-primary">
                    Ir a la ruta
                </a>
            </div>
        </div>
    @endforeach
</div>


{{-- <script src="js/productos.js"></script>
<script src="js/productRender.js"></script> --}}



@endsection