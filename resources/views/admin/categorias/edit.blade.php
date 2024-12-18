@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Editar Categoría</h1>

  <!-- Formulario para editar la categoría -->
  <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <!-- Campo Nombre -->
    <div class="flex flex-col">
      <label for="nombre" class="text-sm font-medium mb-2">Nombre de la Categoría</label>
      <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" required
             class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
      @error('nombre')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Botón Actualizar -->
    <div class="flex space-x-4">
      <button type="submit" 
              class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Actualizar Categoría
      </button>

      <!-- Botón Cancelar -->
      <a href="{{ route('categorias.index') }}" 
         class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
        Cancelar
      </a>
    </div>
  </form>
</div>
@endsection
