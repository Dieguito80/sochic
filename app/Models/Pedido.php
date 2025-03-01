<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_de_compra',
        'estado_de_envio',
    ];

    public function confirmarPedido()
    {
        $this->estado_de_envio = 'Confirmado';
        $this->save();
    }

    public function enviarEmailCompra($email)
    {
        Mail::to($email)->send(new \App\Mail\PedidoConfirmado($this));
    }

    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_pedidos')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }

    public function tieneProductos()
    {
        return $this->productos()->exists();
    }
}
