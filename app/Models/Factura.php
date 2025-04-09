<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'proveedor_id',
        'area_id',
        'user_id',
        'factura_documento',
        'comprobante_pago',
        'imagenes',
        'requisicion_compra',
        'recibi',
        'cotizaciones',
        'cantidad_pagada',
        'fecha_pago',
        'fecha_compra',
        'fecha_entrega'
    ];

    protected $casts = [
        'imagenes' => 'array',
        'cotizaciones' => 'array',
        'fecha_pago' => 'date',
        'fecha_compra' => 'date',
        'fecha_entrega' => 'date'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avances()
    {
        return $this->belongsToMany(Avance::class, 'avance_factura');
    }
}