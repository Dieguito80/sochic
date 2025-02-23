@extends('layouts.app')

@section('titulo')
    Mi carrito
@endsection

@section('contenido')
    <div class="container mx-auto px-4 py-8">
        <!-- Lista de productos -->
        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($productos as $producto)

                <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col">
                    <!-- Imagen del producto -->
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         alt="{{ $producto->nombre }}"
                         class="rounded-lg object-cover h-48 w-full">

                    <!-- Detalles del producto -->
                    <div class="mt-4 flex flex-col flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $producto->nombre }}</h3>

                        <!-- Precios -->
                        <div class="mt-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Precio:</span>
                                <span class="text-lg text-green-600 font-bold">${{ number_format($producto->precio_minorista, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-sm text-gray-500">Mayorista:</span>
                                <span class="text-lg text-blue-600 font-bold">${{ number_format($producto->precio_mayorista, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Opciones (cantidad y eliminar) -->
                    <div class="mt-4 flex justify-between items-center">
                        <!-- Formulario para cantidad -->
                        <form action="{{ route('carrito.actualizar', $producto->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <label for="qty{{ $producto->id }}" class="sr-only">Cantidad</label>
                            <input
                                type="number"
                                name="cantidad"
                                min="1"
                                value="{{ $producto->pivot->cantidad }}"
                                id="qty{{ $producto->id }}"
                                class="h-10 w-16 text-center border border-gray-300 rounded-md text-sm"
                                onchange="this.form.submit()">
                        </form>

                        <!-- Botón para eliminar -->
                        <form action="{{ route('carrito.eliminar', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt text-lg"></i>
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Resumen del carrito -->
        <div class="bg-gray-100 mt-8 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Resumen del Pedido</h2>

            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-500">Subtotal:</span>
                <span class="font-semibold text-gray-800">${{ number_format($total ?? 0, 2) }}</span>
            </div>

            <!-- Botones de acción -->
            <div class="mt-6 flex justify-between">
                <a href="{{ route('productos.categoria') }}"
                   class="px-6 py-3 bg-gray-700 text-white text-sm rounded-md hover:bg-gray-600 transition">
                    Seguir comprando
                </a>
                <a href="{{ route('carritos.historial') }}"
                   class="px-6 py-3 bg-gray-700 text-white text-sm rounded-md hover:bg-gray-600 transition">
                    Historial compras
                </a>
                <a href="{{ route('envio.index' ) }}"
                   class="px-6 py-3 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-500 transition">
                    Continuar compra
                </a>
            </div>

        </div>
    </div>
@endsection
