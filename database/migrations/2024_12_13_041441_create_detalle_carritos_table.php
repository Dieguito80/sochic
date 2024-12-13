<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_carritos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrito_id'); // Relación con el carrito
            $table->unsignedBigInteger('producto_id'); // Relación con el producto
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_carritos');
    }
}

