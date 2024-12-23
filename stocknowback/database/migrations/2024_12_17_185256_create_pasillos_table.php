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
            $table->timestamps(); // Campos created_at y updated_at
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
