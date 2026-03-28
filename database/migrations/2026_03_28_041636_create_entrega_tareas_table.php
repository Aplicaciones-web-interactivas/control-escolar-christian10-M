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
    Schema::create('entrega_tareas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tarea_id')->constrained('tareas')->cascadeOnDelete();
        $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
        $table->string('archivo'); // ruta del PDF
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega_tareas');
    }
};
