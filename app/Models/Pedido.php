<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Pedido extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orden_de_compra',
        'estado_de_envio',
    ];

    /**
     * Confirmar el pedido.
     *
     * @return void
     */
    public function confirmarPedido()
    {
        // Lógica para confirmar el pedido
        $this->estado_de_envio = 'Confirmado';
        $this->save();
    }

    /**
     * Enviar un email al cliente con los detalles de la compra.
     *
     * @param string $email
     * @return void
     */
    public function enviarEmailCompra($email)
    {
        // Ejemplo de cómo enviar un correo utilizando Mailable
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
}

