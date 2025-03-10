<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //
    public function index()
    {
        // Verificar si el usuario ya está autenticado
        if (Auth::check()) {
            return redirect('/home'); // O la ruta que prefieras
        }

        return view('auth.register'); // O la vista de registro que uses
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);//slug lo convierte en una URL en minuscula con guión

        //Validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' =>$request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashea el password en token
            'tipo' => 1
        ]);

        //Autenticar un usuario
            auth()->attempt($request->only('email','password'));


        //Redireccionar
            return redirect()->route('login');


    }    
}