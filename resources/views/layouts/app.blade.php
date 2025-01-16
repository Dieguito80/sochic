<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sochic - @yield('titulo')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
        <script type="module" src="{{ asset('js/productos.js') }}"></script>
        <script type="module" src="{{ asset('js/productosRender.js') }}"></script>
        <!-- vite se utiliza para incluir y compilar archivos CSS (o JavaScript) --> 
        @vite('resources/css/app.css') 
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">             
                <div class="container-w mx-auto flex justify-between items-center">
                    <h1 class="text-4xl font-black">                     
                        Sochic
                    </h1>
                    @if (auth()->check()) 
                    @if(auth()->user()->tipo == 2)
                        <!-- Botones de navegación -->
                        <nav class="space-x-4">
                            <!-- Botón para ir a Productos -->
                            <a href="{{ route('productos.index') }}" 
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Productos
                            </a>

                            <!-- Botón para ir a Categorías -->
                            <a href="{{ route('categorias.index') }}" 
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Categorías
                            </a>

                            <!-- Botón para Gestionar pedidos -->
                            <a href="{{ route('gestion.index') }}" 
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Gestion pedidos
                            </a>
                        </nav>
                    @endif
                    @endif
                    <!-- Autenticar si el usuario esta autenticado-->
                    @auth
                        <nav class="flex gap-4 items-center">
                            <a class="font-bold text-gray-600 text-xl" href="#">
                                Hola:
                                <span class="font-normal">
                                    {{auth()->user()->username}}
                                </span> 
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="font-bold uppercase
                                    text-gray-600 text-xl">
                                    Cerrar Sesión 
                                </button>
                            </form>
                        </nav>
                    @endauth

                    @guest
                        <nav class="flex gap-4 items-center">
                            <a class="font-bold uppercase text-gray-600 text-xl" 
                                href="#">Login</a>
                            <a href="{{ route('register') }}" class="font-bold uppercase
                                 text-gray-600 text-xl">Registro
                            </a>
                        </nav>
                    @endguest
                    <!-- fin -->

                </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase flex justify-center items-center">
            <p>Sochic - Todos los derechos reservados {{ now()->year }}</p>
            <div class="flex  px-10 gap-6">
                <a href="https://www.whatsapp.com/" target="_blank">
                  <i class="fab fa-whatsapp text-gray-700"></i>
                </a>
                <a href="https://www.instagram.com/" target="_blank">
                    <i class="fab fa-instagram text-gray-700"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank">
                    <i class="fab fa-facebook-f text-gray-700"></i>
                </a>
                <a href="https://www.twitter.com/" target="_blank">
                    <i class="fab fa-twitter text-gray-700"></i>
                </a>
            </div>
        </footer>

    </body>
</html>