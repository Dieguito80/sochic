<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        // Verificar si el usuario autenticado es un administrador
        if (auth()->user()->tipo == 2) {
            return redirect()->route('admin.index');
            
        }

        // Si no es administrador, redirigir a la vista correspondiente
        return view('cliente.index', [
            'user' => $user
        ]);
    }
}
