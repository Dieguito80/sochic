@extends('layouts.app')

@section('titulo')

    Mi carrito

@endsection

@section('contenido')
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="mt-8">
                <ul class="space-y-4">
                    @foreach ($productos as $producto)
                        <li class="flex items-start gap-4">
                            <!-- Imagen ajustada -->
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-16 h-16 rounded object-cover">

                            <div>
                                <h3 class="text-sm text-gray-900">{{ $producto->nombre }}</h3>
                                <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                                    <div>
                                        <dt class="inline">Price:</dt>
                                        <dd class="inline">{{ $producto->precio_minorista }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="flex flex-1 items-center justify-end gap-2">
                                <form>
                                    <label for="qty{{ $producto->id }}" class="sr-only">Quantity</label>
                                    <input
                                        type="number"
                                        min="1"
                                        value="{{ $producto->pivot->cantidad }}"  
                                        id="qty{{ $producto->id }}"
                                        class="h-8 w-12 rounded border-gray-200 bg-gray-50 p-0 text-center text-xs text-gray-600"
                                    />
                                </form>

                                <form action="{{ route('carrito.eliminar', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-600 transition hover:text-red-600">
                                        <span class="sr-only">Remove item</span>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-8 flex justify-end border-t border-gray-100 pt-8">
                    <div class="w-screen max-w-lg space-y-4">
                        <dl class="space-y-0.5 text-sm text-gray-700">
                            <!-- Aquí puedes agregar la lógica para mostrar el total, IVA, etc. -->
                        </dl>
                        <div class="mt-8 flex justify-between items-center border-t border-gray-100 pt-8">
                            <!-- Botón de Seguir Comprando -->
                            <a href="{{ route('productos.categoria') }}" class="block rounded bg-gray-700 px-5 py-3 text-sm text-gray-100 transition hover:bg-gray-600">
                                Seguir comprando
                            </a>
                            
                            <!-- Botón de Comprar -->
                            <a href="#" class="block rounded bg-gray-700 px-5 py-3 text-sm text-gray-100 transition hover:bg-gray-600">
                                Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
