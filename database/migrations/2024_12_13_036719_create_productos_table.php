<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('cantidad_stock');
            $table->decimal('precio_minorista', 10, 2);
            $table->decimal('precio_mayorista', 10, 2);
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')
                ->constrained('categorias') // Assuming your categories table is named 'categorias'
                ->onDelete('cascade')
                ->default(1); // Assuming category with ID 1 exists
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
}

