<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            // Required fields
            $table->string('nombre');
            $table->string('rfc');
            $table->string('nombre_empresa');
            
            // Optional file fields
            $table->string('padron_proveedores')->nullable();
            $table->string('registro_compranet')->nullable();
            $table->string('constancia_sat')->nullable();
            $table->string('sat_cumplimiento_obligaciones')->nullable();
            $table->string('comprobante_domicilio')->nullable();
            $table->string('infonavit_constancia_fiscal')->nullable();
            $table->string('imss_opinion_cumplimiento')->nullable();
            $table->string('constancia_no_sancion')->nullable();
            $table->string('constancia_inhabilitacion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
};