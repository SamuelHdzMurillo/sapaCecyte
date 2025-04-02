<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with(['proveedor', 'area', 'user'])->get();
        return response()->json($facturas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedors,id',
            'area_id' => 'required|exists:areas,id',
            'user_id' => 'required|exists:users,id',
            'factura_documento' => 'required|string',
            'comprobante_pago' => 'required|string',
            'imagenes' => 'nullable|array',
            'requisicion_compra' => 'required|string',
            'recibi' => 'required|string',
            'cotizaciones' => 'nullable|array',
            'cantidad_pagada' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'fecha_compra' => 'required|date',
            'fecha_entrega' => 'required|date'
        ]);

        $factura = Factura::create($request->all());
        return response()->json($factura, 201);
    }

    public function show(Factura $factura)
    {
        return response()->json($factura->load(['proveedor', 'area', 'user']));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'proveedor_id' => 'exists:proveedors,id',
            'area_id' => 'exists:areas,id',
            'user_id' => 'exists:users,id',
            'factura_documento' => 'string',
            'comprobante_pago' => 'string',
            'imagenes' => 'nullable|array',
            'requisicion_compra' => 'string',
            'recibi' => 'string',
            'cotizaciones' => 'nullable|array',
            'cantidad_pagada' => 'numeric',
            'fecha_pago' => 'date',
            'fecha_compra' => 'date',
            'fecha_entrega' => 'date'
        ]);

        $factura->update($request->all());
        return response()->json($factura);
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return response()->json(null, 204);
    }
}