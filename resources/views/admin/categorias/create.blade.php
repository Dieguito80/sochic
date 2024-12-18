@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Agregar Nueva Categoría</h1>

  <form action="{{ route('categorias.store') }}" method="POST" class="space-y-4">
    @csrf
    
    <div class="flex flex-col">
      <label for="nombre" class="text-sm font-medium mb-2">Nombre de la Categoría</label>
      <input type="text" name="nombre" id="nombre" required 
             class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <button type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
      Crear Categoría
    </button>
  </form>
</div>
@endsection
