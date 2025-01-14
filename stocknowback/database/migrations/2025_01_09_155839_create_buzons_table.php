<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buzones', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->unsignedBigInteger('jefe_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('producto_id'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jefe_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade'); // Relación con productos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buzones');
    }
};
