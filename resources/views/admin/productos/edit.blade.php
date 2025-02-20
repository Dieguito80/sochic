@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Editar Producto</h1>

  <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')
    
    <div class="flex flex-col">
      <label for="nombre" class="text-sm font-medium mb-2">Nombre del Producto</label>
      <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="precio_minorista" class="text-sm font-medium mb-2">Precio Minorista</label>
      <input type="number" name="precio_minorista" id="precio_minorista" value="{{ old('precio_minorista', $producto->precio_minorista) }}" required min="0" 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="precio_mayorista" class="text-sm font-medium mb-2">Precio Mayorista</label>
      <input type="number" name="precio_mayorista" id="precio_mayorista" value="{{ old('precio_mayorista', $producto->precio_mayorista) }}" required min="0" 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="cantidad_stock" class="text-sm font-medium mb-2">Cantidad Stock</label>
      <input type="number" name="cantidad_stock" id="cantidad_stock" value="{{ old('cantidad_stock', $producto->cantidad_stock) }}" required min="0" 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="imagen" class="text-sm font-medium mb-2">Imagen</label>
      <input type="file" name="imagen" id="imagen" 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
      @if($producto->imagen)
        <p class="mt-2 text-sm text-gray-600">Imagen actual:</p>
        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-32 h-32 object-cover mt-2">
      @endif
    </div>

    <div class="flex flex-col">
      <label for="descripcion" class="text-sm font-medium mb-2">Descripción</label>
      <textarea name="descripcion" id="descripcion" rows="4" required 
        class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">{{ old('descripcion', $producto->descripcion) }}</textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
      Actualizar Producto
    </button>
  </form>
  
  @if ($producto->cantidad_stock <= 0)
    <div class="mt-4 bg-yellow-200 text-yellow-800 p-4 rounded-md">
      Publicación pausada.
    </div>
  @endif
</div>
@endsection
