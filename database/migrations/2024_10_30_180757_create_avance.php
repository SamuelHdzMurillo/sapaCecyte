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
        Schema::create('avances', function (Blueprint $table) {
            $table->id();
            $table->integer('costo_Avance');
            $table->timestamp('fecha_Avance');
            $table->string('descripcion_Avance');
            $table->string('evidencia_Avance');
            $table->foreignId('idProyecto')->constrained('proyects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avance');
    }
};
