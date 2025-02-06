<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_de_compra',
        'user_id',
        'estado'
    ];

    

    /**
     * Crear un nuevo carrito.
     *
     * @return self
     */
    public function crearCarrito()
    {
        // Lógica para crear un carrito
    }

    // Relación con Usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Eliminar el carrito.
     *
     * @return void
     */
    public function eliminarCarrito()
    {
        // Lógica para eliminar un carrito
    }

    /**
     * Modificar el carrito.
     *
     * @param array $data
     * @return void
     */
    public function modificarCarrito(array $data)
    {
        // Lógica para modificar un carrito
    }

    /**
     * Realizar la compra asociada al carrito.
     *
     * @return void
     */
    public function realizarCompra()
    {
        // Lógica para realizar la compra
    }

    // Relación con productos (si un carrito contiene múltiples productos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_carritos')
                    ->withPivot('cantidad', 'subtotal')
                    ->withTimestamps();
    }

    // Relación con un usuario (si el carrito pertenece a un usuario específico)
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class);
    }

    public function carrito()
{
    $productos = auth()->user()->carrito; // O la lógica para obtener los productos en el carrito

    $total = 0;

    foreach ($productos as $producto) {
        $cantidad = $producto->pivot->cantidad;
        $precio = ($cantidad >= 5) ? $producto->precio_mayorista : $producto->precio_minorista;
        $total += $precio * $cantidad;
    }

    return view('carrito.index', compact('productos', 'total'));
}
}

