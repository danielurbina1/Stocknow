<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre'); 
            $table->decimal('precio', 8, 2); 
            $table->unsignedBigInteger('pasillo_id'); 
            $table->integer('stock')->default(0); 
            $table->integer('stock_minimo');
            $table->string('imagen')->nullable();
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
