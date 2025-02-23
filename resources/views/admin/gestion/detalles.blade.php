@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h1>

        <p><strong>Usuario:</strong> {{ $pedido->usuario->name }}</p>
        <p><strong>Fecha de Compra:</strong> {{ $pedido->fecha_de_compra }}</p>
        <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
        <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
        <p><strong>Comprobante:</strong> {{ $pedido->comprobante }}</p>

        <h2 class="text-2xl font-semibold mt-4 mb-2">Productos del Pedido</h2>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Producto</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Cantidad</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->detalleCarritos as $detalle)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $detalle->producto->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detalle->cantidad }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detalle->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection