@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Detalles del Pedido</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
            <p class="text-gray-700"><strong class="font-semibold">Usuario:</strong> {{ $envio->nombre }}</p>
            <p class="text-gray-700"><strong class="font-semibold">Fecha de Compra:</strong> {{ $envio->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-gray-700"><strong class="font-semibold">Estado:</strong> 
                <span class="px-3 py-1 rounded-md text-white text-sm font-semibold
                    {{ $estadoCarrito == 1 ? 'bg-yellow-500' : '' }}
                    {{ $estadoCarrito == 2 ? 'bg-green-500' : '' }}
                    {{ $estadoCarrito == 3 ? 'bg-blue-500' : '' }}
                    {{ $estadoCarrito == 4 ? 'bg-red-500' : '' }}">
                    @switch($estadoCarrito)
                        @case(1) Comprado @break
                        @case(2) Aprobado @break
                        @case(3) Enviado @break
                        @case(4) Rechazado @break
                        @default Desconocido
                    @endswitch
                </span>
            </p>
        </div>
        <div>
            <p class="text-gray-700"><strong class="font-semibold">Dirección:</strong> {{ $envio->direccion }}</p>
            <p class="text-gray-700"><strong class="font-semibold">Teléfono:</strong> {{ $envio->telefono }}</p>
            <p class="text-gray-700"><strong class="font-semibold">Comprobante:</strong> {{ $envio->comprobante }}</p>
        </div>
    </div>

    <h2 class="text-2xl font-semibold mt-6 mb-4 text-gray-800 border-b pb-2">Productos del Carrito</h2>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 rounded-lg shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-3 text-left text-gray-700">Imagen</th>
                    <th class="border px-4 py-3 text-left text-gray-700">Producto</th>
                    <th class="border px-4 py-3 text-left text-gray-700">Cantidad</th>
                    <th class="border px-4 py-3 text-left text-gray-700">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($carrito as $detalle)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="border px-4 py-3">
                            @if ($detalle->producto->imagen)
                                <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" 
                                    alt="{{ $detalle->producto->nombre }}" 
                                    class="h-16 w-16 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400">Sin imagen</span>
                            @endif
                        </td>
                        <td class="border px-4 py-3 text-gray-800">{{ $detalle->producto->nombre }}</td>
                        <td class="border px-4 py-3 text-gray-800">{{ $detalle->cantidad }}</td>
                        <td class="border px-4 py-3 text-gray-800 font-semibold">${{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="{{ route('gestion.cambioEstado', $carritoId) }}" method="POST" class="mt-6 flex flex-col md:flex-row gap-4 items-center">
        @csrf
        @method('PUT')
    
        <label for="estado" class="font-semibold text-gray-700">Cambiar Estado:</label>
        
        <select name="estado" id="estado" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="this.form.submit()">
            <option value="1" {{ $estadoCarrito == 1 ? 'selected' : '' }}>Comprado</option>
            <option value="2" {{ $estadoCarrito == 2 ? 'selected' : '' }}>Aprobado</option>
            <option value="3" {{ $estadoCarrito == 3 ? 'selected' : '' }}>Enviado</option>
            <option value="4" {{ $estadoCarrito == 4 ? 'selected' : '' }}>Rechazado</option>
        </select>
    </form>
</div>
@endsection
