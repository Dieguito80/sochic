@extends('layouts.app')

@section('titulo')
    Historial de Carritos
@endsection

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mis Carritos</h2>

        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($carritos as $carrito)
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Carrito #{{ $carrito->id }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($carrito->estado === 1) bg-yellow-200 text-yellow-800
                            @elseif($carrito->estado === 2) bg-green-200 text-green-800
                            @elseif($carrito->estado === 3) bg-red-200 text-red-800
                            @endif">
                            @if($carrito->estado == 1) Iniciado
                            @elseif($carrito->estado == 2) Aceptado
                            @elseif($carrito->estado == 3) Finalizado
                            @endif
                        </span>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Productos:</h4>
                        @foreach ($carrito->productos as $producto)
                            <div class="flex items-center mb-2">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-12 h-12 rounded-md mr-2">
                                <div>
                                    <span class="text-sm text-gray-600">{{ $producto->nombre }}</span>
                                    <br>
                                    <span class="text-xs text-gray-500">Cantidad: {{ $producto->pivot->cantidad }}</span>
                                    <br>
                                    <span class="text-xs text-gray-500">
                                        Precio: ${{ number_format(($producto->pivot->cantidad >= 5) ? $producto->precio_mayorista : $producto->precio_minorista, 2) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Total:</span>
                        <span class="text-lg font-bold text-gray-800">${{ number_format($carrito->total, 2) }}</span>
                    </div>

                    <div class="text-sm text-gray-500 mb-4">
                        Creado el: {{ $carrito->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('productos.categoria') }}" class="px-6 py-3 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-500 transition">
                Seguir Comprando
            </a>
        </div>
    </div>
@endsection