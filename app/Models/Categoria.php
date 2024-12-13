<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    /**
     * Agregar un producto a la categoría.
     *
     * @param \App\Models\Producto $producto
     * @return void
     */
    public function agregarProducto($producto)
    {
        // Lógica para agregar un producto a la categoría
    }

    /**
     * Modificar un producto de la categoría.
     *
     * @param \App\Models\Producto $producto
     * @return void
     */
    public function modificarProducto($producto)
    {
        // Lógica para modificar un producto de la categoría
    }

    /**
     * Eliminar un producto de la categoría.
     *
     * @param \App\Models\Producto $producto
     * @return void
     */
    public function eliminarProducto($producto)
    {
        // Lógica para eliminar un producto de la categoría
    }

    /**
     * Mostrar productos de la categoría.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function mostrarProducto()
    {
        // Lógica para mostrar productos de la categoría
    }
}

