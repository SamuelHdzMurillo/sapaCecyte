<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avance_factura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avance_id')->constrained('avances')->onDelete('cascade');
            $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avance_factura');
    }
}; 