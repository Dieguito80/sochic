<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sochic - @yield('titulo')</title>
        <!-- vite se utiliza para incluir y compilar archivos CSS (o JavaScript) --> 
        @vite('resources/css/app.css') 
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">             
                <div class="container-w mx-auto flex justify-between items-center">
                    <h1 class="text-4xl font-black">                     
                        Sochic
                    </h1>

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

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            Sochic - Todos los derechos reservados 
            {{ now()->year }} <!-- agrega fecha --> 
        </footer>

    </body>
</html>