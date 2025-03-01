<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'cantidad_stock',
        'precio_minorista',
        'precio_mayorista',
        'imagen',
        'descripcion',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    // Relación con carritos
    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'detalle_carritos')
                    ->withPivot('cantidad', 'subtotal')
                    ->withTimestamps();
    }

    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class);
    }

    // Relación con envíos
    public function envios()
    {
        return $this->hasMany(Envio::class);
    }
}
