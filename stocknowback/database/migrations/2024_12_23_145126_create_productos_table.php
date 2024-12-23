<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // ID único del producto
            $table->string('nombre'); // Nombre del producto
            $table->decimal('precio', 8, 2); // Precio del producto
            $table->unsignedBigInteger('pasillo_id'); // Relación con la tabla pasillos
            $table->integer('stock')->default(0); // Stock del producto
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('pasillo_id')->references('id')->on('pasillos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
