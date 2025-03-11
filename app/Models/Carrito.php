<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_de_compra',
        'user_id',
        'estado',
        'direccion',
        'telefono',
        'comprobante'
    ];

    public function envio()
{
    return $this->hasOne(Envio::class);
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_carritos')
            ->withPivot('cantidad', 'subtotal')
            ->withTimestamps();
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class);
    }

    public function getTotalAttribute()
    {
        return $this->productos->sum(function ($producto) {
            $cantidad = $producto->pivot->cantidad;
            $precio = ($cantidad >= 5) ? $producto->precio_mayorista : $producto->precio_minorista;
            return $precio * $cantidad;
        });
    }
}