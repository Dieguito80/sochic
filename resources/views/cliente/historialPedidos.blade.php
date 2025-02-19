@extends('layouts.app')

@section('titulo')
    Historial de Carritos
@endsection

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mis Carritos</h2>

        <!-- Lista de carritos -->
        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($carritos as $carrito)
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col">
                    <!-- Estado del carrito -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Carrito #{{ $carrito->id }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            @if($carrito->estado === '1') bg-yellow-200 text-yellow-800
                            @elseif($carrito->estado === '2') bg-green-200 text-green-800
                            @elseif($carrito->estado === '3') bg-red-200 text-red-800
                            @endif">
                            @if($carrito->estado == '1') Iniciado
                            @elseif($carrito->estado == '2') Aceptado
                            @elseif($carrito->estado == '3') Finalizado
                            @endif
                        </span>
                    </div>

                    <!-- Total del carrito -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-500">Total:</span>
                        <!-- <span class="text-lg font-bold text-gray-800">${{ number_format($carrito->total, 2) }}</span> -->
                        <span class="text-lg font-bold text-gray-800">100</span>
                    </div>

                    <!-- Fecha de creación -->
                    <div class="text-sm text-gray-500 mb-4">
                        Creado el: {{ $carrito->created_at->format('d/m/Y H:i') }}
                    </div>

                    <!-- Botón para ver productos del carrito -->
                    <a href="{{ route('carritos.ver', $carrito->id) }}"
                       class="px-6 py-3 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-500 transition text-center">
                        Ver productos
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
