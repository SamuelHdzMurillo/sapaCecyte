<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            // Fix the foreign key reference to match the correct table name
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Rest of the fields remain the same
            $table->string('factura_documento')->nullable();
            $table->string('comprobante_pago')->nullable();
            $table->json('imagenes')->nullable();
            $table->string('requisicion_compra')->nullable();
            $table->string('recibi')->nullable();
            $table->json('cotizaciones')->nullable();
            $table->decimal('cantidad_pagada', 10, 2);
            $table->date('fecha_pago');
            $table->date('fecha_compra');
            $table->date('fecha_entrega');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
};