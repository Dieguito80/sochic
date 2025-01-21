@extends('layouts.app')

@section('contenido')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-4">Agregar Nuevo Usuario</h1>

  <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-4">
    @csrf

    <div class="flex flex-col">
      <label for="name" class="text-sm font-medium mb-2">Nombre</label>
      <input type="text" name="name" id="name" required class="rounded-md border border-gray-300 p-2">
    </div>

    <div class="flex flex-col">
      <label for="username" class="text-sm font-medium mb-2">Username</label>
      <input type="text" name="username" id="username" required class="rounded-md border border-gray-300 p-2">
    </div>

    <div class="flex flex-col">
      <label for="email" class="text-sm font-medium mb-2">Email</label>
      <input type="email" name="email" id="email" required class="rounded-md border border-gray-300 p-2">
    </div>

    <div class="flex flex-col">
      <label for="password" class="text-sm font-medium mb-2">Contraseña</label>
      <input type="password" name="password" id="password" required class="rounded-md border border-gray-300 p-2">
    </div>

    <div class="flex flex-col">
      <label for="password_confirmation" class="text-sm font-medium mb-2">Confirmar Contraseña</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required class="rounded-md border border-gray-300 p-2">
    </div>

    <div class="flex flex-col">
      <label for="tipo" class="text-sm font-medium mb-2">Tipo de Usuario</label>
      <select name="tipo" id="tipo" required class="rounded-md border border-gray-300 p-2">
        <option value="admin">Admin</option>
        <option value="user">Usuario</option>
      </select>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Crear Usuario</button>
  </form>
</div>
@endsection
