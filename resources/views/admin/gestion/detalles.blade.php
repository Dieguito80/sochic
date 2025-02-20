@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h1>

  <p><strong>Cliente:</strong> {{ $pedido->user->name }}</p>
  <p><strong>Correo:</strong> {{ $pedido->user->email }}</p>
  <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
  <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>
  <p><strong>Fecha de Compra:</strong> {{ $pedido->fecha_de_compra }}</p>
  <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

  <h2 class="text-xl font-bold mt-6">Productos Comprados</h2>
  <ul class="list-disc ml-6">
    @foreach($pedido->productos as $producto)
      <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }} - ${{ $producto->precio }}</li>
    @endforeach
  </ul>

  @if($pedido->comprobante)
    <h2 class="text-xl font-bold mt-6">Comprobante de Pago</h2>
    <img src="{{ asset('storage/' . $pedido->comprobante) }}" class="w-64 h-auto mt-2">
  @endif

  <div class="mt-6">
    <a href="{{ route('gestion.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
      ← Volver
    </a>
  </div>
</div>
@endsection
