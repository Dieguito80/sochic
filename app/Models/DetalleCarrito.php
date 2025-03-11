<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'subtotal',
    ];

    /**
     * Relación con el modelo Carrito.
     */
    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }
    public function envio()
    {
        return $this->belongsTo(envio::class);
    }
    /**
     * Relación con el modelo Producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

