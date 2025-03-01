<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sochic - @yield('titulo')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
        <script type="module" src="{{ asset('js/productos.js') }}"></script>
        <script type="module" src="{{ asset('js/productosRender.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- vite se utiliza para incluir y compilar archivos CSS (o JavaScript) --> 
        @vite('resources/css/app.css') 
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b-4 border-blue-600 bg-gradient-to-r from-blue-500 to-indigo-500 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-4">
                    <!-- Logo circular con borde más grande -->
                    <img src="{{ asset('img/logo.png') }}" 
                        alt="Sochic Logo" 
                        class="h-24 w-24 rounded-full border-4 border-blue-600 shadow-md">
                    
                    <!-- Texto "Ecommerce" al costado -->
                    <span class="text-4xl font-extrabold text-white tracking-wide">Ecommerce</span>
                </a>
    
                @if (auth()->check()) 
                @if(auth()->user()->tipo == 2)
                    <nav class="flex space-x-4 ml-auto mx-4">
                        <a href="{{ route('productos.index') }}" class="bg-white text-blue-600 font-semibold px-5 py-2 rounded-full hover:bg-blue-600 hover:text-white transition-all">
                            Productos
                        </a>
                        <a href="{{ route('usuarios.index') }}" class="bg-white text-green-600 font-semibold px-5 py-2 rounded-full hover:bg-green-600 hover:text-white transition-all">
                            Asignar Rol
                        </a>
                        <a href="{{ route('categorias.index') }}" class="bg-white text-purple-600 font-semibold px-5 py-2 rounded-full hover:bg-purple-600 hover:text-white transition-all">
                            Categorías
                        </a>
                        <a href="{{ route('gestion.index') }}" class="bg-white text-red-600 font-semibold px-5 py-2 rounded-full hover:bg-red-600 hover:text-white transition-all">
                            Gestion pedidos
                        </a>
                    </nav>
                @endif
                @endif
    
                @auth
                    <nav class="flex gap-4 items-center">
                        <a class="font-bold text-white text-xl" href="#">
                            Hola:
                            <span class="font-normal">
                                {{auth()->user()->username}}
                            </span> 
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-white bg-red-500 px-4 py-2 rounded-full hover:bg-red-700 transition-all">
                                Cerrar Sesión 
                            </button>
                        </form>
                    </nav>
                @endauth
    
                @guest
                    <nav class="flex gap-4 items-center">
                        <a class="font-bold uppercase text-white text-xl" href="#">Login</a>
                        <a href="{{ route('register') }}" class="font-bold uppercase text-white text-xl">Registro</a>
                    </nav>
                @endguest
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