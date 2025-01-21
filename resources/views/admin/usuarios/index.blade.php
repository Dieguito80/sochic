@extends('layouts.app')

@section('contenido')
<div class="container mx-auto py-8">
  <h1 class="text-3xl font-bold mb-4">Administrar Usuarios</h1>

  <a href="{{ route('usuarios.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4">Agregar Usuario</a>

  <table class="min-w-full bg-white border border-gray-200 rounded-lg mt-4 shadow-md">
    <thead>
      <tr class="text-left bg-gray-100">
        <th class="py-2 px-4">ID</th>
        <th class="py-2 px-4">Nombre</th>
        <th class="py-2 px-4">Email</th>
        <th class="py-2 px-4">Username</th>
        <th class="py-2 px-4">Tipo</th>
        <th class="py-2 px-4">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($usuarios as $usuario)
        <tr class="border-b">
          <td class="py-2 px-4">{{ $usuario->id }}</td>
          <td class="py-2 px-4">{{ $usuario->name }}</td>
          <td class="py-2 px-4">{{ $usuario->email }}</td>
          <td class="py-2 px-4">{{ $usuario->username }}</td>
          <td class="py-2 px-4">{{ $usuario->tipo }}</td>
          <td class="py-2 px-4">
            <div class="flex gap-2">
              <a href="{{ route('usuarios.edit', $usuario->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Editar</a>
              <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Eliminar</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
