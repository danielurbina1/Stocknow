<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasillosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasillos', function (Blueprint $table) {
            $table->id(); // ID único para cada pasillo
            $table->string('nombre'); // Nombre del pasillo
            $table->string('descripcion')->nullable(); // Descripción opcional
            $table->unsignedBigInteger('user_id'); // Relación con la tabla pasillos
            $table->timestamps(); // Campos created_at y updated_at
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasillos');
    }
}
