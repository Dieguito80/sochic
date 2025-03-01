<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envio extends Model
{
    use HasFactory;

    protected $table = 'envios'; // Se mantiene explícitamente por el nombre en minúsculas

    protected $fillable = [
        'carrito_id',
        'nombre',
        'apellido',
        'direccion',
        'correo',
        'telefono',
        'comprobante_path',
    ];

    /**
     * Relación con el carrito.
     */
    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }
}
