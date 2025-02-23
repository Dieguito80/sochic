<?php


namespace App\Http\Controllers; // Asegúrate de que el namespace sea correcto

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar la clase Auth
use App\Models\Carrito; // Asegúrate de que la ruta al modelo Carrito sea correcta
use App\Models\Envio; // Asegúrate de que la ruta al modelo Envio sea correcta
class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cliente.formulario'); // Vista del formulario
    }

    public function store(Request $request)
    {
        // Verificar la autenticación del usuario
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        // Obtener el carrito del usuario
        $carrito = Carrito::where('user_id', Auth::id())->where('estado', 0)->first();

        // Verificar si el carrito existe
        if (!$carrito) {
            return redirect()->back()->with('error', 'No se encontró un carrito activo.');
        }

        $carritoId = $carrito->id;

        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:formularios',
            'telefono' => 'required|string|max:15',
            'comprobante' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Guardar el archivo en la carpeta "storage/app/public/comprobantes"
        $path = $request->file('comprobante')->store('comprobantes', 'public');

        // Guardar los datos en la base de datos
        Envio::create([
            'nombre' => $validated['nombre'],
            'carrito_id' => $carritoId,
            'apellido' => $validated['apellido'],
            'direccion' => $validated['direccion'],
            'correo' => $validated['correo'],
            'telefono' => $validated['telefono'],
            'comprobante_path' => $path,
        ]);

        // Actualizar el estado del carrito
        $categoria = Carrito::findOrFail($carritoId);
        $categoria->update([
            'estado' => 1,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('carrito.index')->with('success', 'Formulario enviado correctamente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
