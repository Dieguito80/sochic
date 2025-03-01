@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Editar Usuario</h1>

  <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div class="flex flex-col">
      <label for="name" class="text-sm font-medium mb-2">Nombre</label>
      <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="username" class="text-sm font-medium mb-2">Username</label>
      <input type="text" name="username" id="username" value="{{ old('username', $usuario->username) }}" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="email" class="text-sm font-medium mb-2">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="password" class="text-sm font-medium mb-2">Contraseña (opcional)</label>
      <input type="password" name="password" id="password" class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="password_confirmation" class="text-sm font-medium mb-2">Confirmar Contraseña (opcional)</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
    </div>

    <div class="flex flex-col">
      <label for="tipo" class="text-sm font-medium mb-2">Tipo de Usuario</label>
      <select name="tipo" id="tipo" required class="rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-blue-500 focus:ring-1">
        <option value="2" {{ old('tipo', $usuario->tipo) == 2 ? 'selected' : '' }}>Administrador</option>
        <option value="1" {{ old('tipo', $usuario->tipo) == 1 ? 'selected' : '' }}>Usuario</option>
      </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Actualizar Usuario</button>
  </form>
</div>
@endsection
