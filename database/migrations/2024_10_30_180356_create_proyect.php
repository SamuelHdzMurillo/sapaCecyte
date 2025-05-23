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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_Proyecto');
            $table->string('descripcion_Proyecto');
            $table->integer('presupuesto_Proyecto');
            $table->string('fechaInicio_Proyecto');
            $table->string('fechaFin_Proyecto');
            $table->string('comentario_Proyecto');

            $table->foreignId('idPrograma')->constrained('programs');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('proyects');
}

};
