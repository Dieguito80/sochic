@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Listado de Categorías</h1>

  <!-- Mensajes de éxito -->
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <!-- Botón para agregar nueva categoría -->
  <div class="mb-6">
    <a href="{{ route('categorias.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
      Agregar Nueva Categoría
    </a>
  </div>

  <!-- Tabla de Categorías -->
  <div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($categorias as $categoria)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $categoria->id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $categoria->nombre }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
              <!-- Botón Editar -->
              <a href="{{ route('categorias.edit', $categoria->id) }}" 
                 class="bg-yellow-500 text-white px-3 py-1 ml-3 rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                Editar
              </a>
              
              <!-- Botón Eliminar -->
              <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')" 
                        class="bg-red-500 text-white px-3 py-1 ml-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
              No hay categorías registradas.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
