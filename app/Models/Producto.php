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

    // Relación con carritos
    public function carritos()
    {
        return $this->belongsToMany(Carrito::class)->withPivot('cantidad');
    }

    public function detalleCarritos()
    {
        return $this->hasMany(DetalleCarrito::class);
    }
}

