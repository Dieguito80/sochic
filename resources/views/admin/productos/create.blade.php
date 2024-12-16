@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Agregar Nuevo Producto</h1>

  <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    
    <div class="flex flex-col">
      <label for="nombre" class="text-sm font-medium mb-2">Nombre del Producto</label>
      <input type="text" name="nombre" id="nombre" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="precio_minorista" class="text-sm font-medium mb-2">precio_minorista</label>
      <input type="number" name="precio_minorista" id="precio_minorista" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="precio_mayorista" class="text-sm font-medium mb-2">precio_mayorista</label>
      <input type="number" name="precio_mayorista" id="precio_mayorista" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="cantidad_stock" class="text-sm font-medium mb-2">Cantidad_stock</label>
      <input type="number" name="cantidad_stock" id="cantidad_stock" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="imagen" class="text-sm font-medium mb-2">Imagen</label>
      <input type="file" name="imagen" id="imagen" class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="descripcion" class="text-sm font-medium mb-2">Descripción</label>
      <textarea name="descripcion" id="descripcion" rows="4" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1"></textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Crear Producto</button>
  </form>
</div>
@endsection