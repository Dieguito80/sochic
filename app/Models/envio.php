<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envio extends Model
{
    use HasFactory;

    protected $table = 'envios';

    protected $fillable = [
        'carrito_id',
        'nombre',
        'apellido',
        'direccion',
        'correo',
        'telefono',
        'comprobante_path',
    ];
}
