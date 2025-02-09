@extends('layouts.app')

@section('titulo', 'Formulario de Envío')

@section('contenido')
<div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    <!-- Contenedor principal con diseño mejorado -->
    <div class="rounded-2xl shadow-lg max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8 bg-white p-8">
        
        <!-- Sección del QR con alias y pasos -->
        <div class="w-full md:w-1/3 flex flex-col items-center bg-gray-100 p-6 rounded-2xl">
            <p class="text-md font-semibold text-gray-800 mb-2">Alias: diego.antonio.herrera.</p>
            <img src="{{ asset('img/QR.png') }}" alt="Código QR" class="w-40 h-40 md:w-48 md:h-48">
            
            <!-- Pasos debajo del QR -->
            <div class="mt-4 text-center text-gray-700 text-sm space-y-2">
                <p><strong>Paso 1:</strong> Escanear QR y realizar el pago</p>
                <p><strong>Paso 2:</strong> Completar el formulario</p>
                <p><strong>Paso 3:</strong> Subir comprobante de pago</p>
                <p><strong>Paso 4:</strong> Enviar</p>
            </div>
        </div>

        <!-- Sección del Formulario -->
        <div class="w-full md:w-2/3">
            <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">Datos personales para el envío</h1>

            <!-- Botón para regresar -->
            <div class="mb-6 text-left">
                <a href="{{ url()->previous() }}" 
                    class="inline-block px-4 py-2 bg-gray-500 text-white font-medium text-sm rounded-lg shadow-md hover:bg-gray-600 transition">
                    ← Volver
                </a>
            </div>

            <form action="{{ route('formulario.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nombre y Apellido -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombre" name="nombre" 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ingresa tu nombre" required>
                    </div>

                    <div>
                        <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" id="apellido" name="apellido" 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ingresa tu apellido" required>
                    </div>
                </div>

                <!-- Dirección -->
                <div class="mt-4">
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Calle principal" required>
                </div>

                <!-- Correo y Teléfono -->
                <div class="grid gap-6 md:grid-cols-2 mt-4">
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                        <input type="email" id="correo" name="correo" 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="ejemplo@correo.com" required>
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" 
                            class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="(+54) 123-456-7890" required>
                    </div>
                </div>

                <!-- Subir comprobante -->
                <div class="mt-6">
                    <label for="comprobante" class="block text-sm font-medium text-gray-700">Subir comprobante de pago</label>
                    <input type="file" id="comprobante" name="comprobante" 
                        class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        accept="image/*" required>
                </div>

                <!-- Botón de enviar -->
                <div class="mt-6 text-center">
                    <button type="submit" 
                        class="w-full px-6 py-3 bg-indigo-600 text-white font-medium text-lg rounded-lg shadow-md hover:bg-indigo-500 transition">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
