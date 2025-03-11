@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-4">Gestión de Pedidos</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('gestion.index') }}" method="GET" class="mb-4 flex justify-end">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Buscar por usuario..." value="{{ request('search') }}" class="border rounded-lg px-3 py-2 mr-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Buscar</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">ID Carrito</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Usuario</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Fecha de Compra</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Estado</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $pedido->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $pedido->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($pedido->envio && $pedido->envio->created_at)
                                    {{ $pedido->envio->created_at->format('d/m/Y H:i') }}
                                @else
                                    Sin fecha de envío
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                @php
                                    $estadoCarrito = $pedido->estado; // Asumiendo que $pedido->estado contiene el número de estado
                                @endphp
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
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('gestion.show', $pedido->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                No hay pedidos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection