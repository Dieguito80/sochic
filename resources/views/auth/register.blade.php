@extends('layouts.app')

@section('titulo')

        Registrate en SOCHIC

@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}"  alt="imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <!-- URL para enviar datos al formulario -->
            <form action="{{ route('register') }}" method="POST" novalidate>
                 
                @csrf <!--evita ataques de cross site request -->
                    <div class="mb-5"> 
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                                Nombre
                        </label>
                                
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            placeholder="Tu Nombre"
                            class="border p-3 w-full rounded @error('name') border-red-500
                        @enderror"  
                        maxlength="30"                  
                    value="{{ old('name')}}"            
                        /> <!-- arriba value no deja que el nombre se elimine -->

                    <!-- valicaciones formulario--> 
                        @error('name')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                            text-center"> {{ $message}} </p>
                        @enderror                    
                    </div>  
                
                <div class="mb-5"> 
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                        </label>

                    <input 
                        id="username" 
                        name="username" 
                        type="text" 
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded @error('username') border-red-500
                        @enderror" 
                        maxlength="20"                   
                    value="{{ old('username')}}"
                    /> 

                    <!-- valicaciones formulario--> 
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ $message}} </p>
                    @enderror                                                    
                </div>  

                <div class="mb-5"> 
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                            Email
                        </label>
                        
                    <input 
                        id="email" 
                        name="email" 
                        type="text" 
                        placeholder="Tu Email de Registro"
                        class="border p-3 w-full rounded @error('email') border-red-500
                        @enderror"   
                        maxlength="60"                 
                    value="{{ old('email')}}"
                    />  

                    <!-- valicaciones formulario--> 
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ $message}} </p>
                    @enderror                                                   
                </div> 

                <div class="mb-5"> 
                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password
                        </label>
                        
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="Password de Registro"
                        class="border p-3 w-full rounded @error('password') border-red-500
                        @enderror"                    
                    
                    /> 
                    <!-- valicaciones formulario--> 
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 
                        text-center"> {{ $message}} </p>
                    @enderror                                                    
                </div>

               <div class="mb-5"> 
                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                            Repetir Password
                        </label>
                       
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Repite tu Password"
                        class="border p-3 w-full rounded"
                    />                                                    
               </div>

                    <input
                        type="submit"
                        value="Crear Cuenta"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                        uppercase font-bold w-full p-3  text-white rounded-lg"              
                    />

            </form>
        </div>
    </div>

@endsection