<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'factura_documento' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'comprobante_pago' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'file|mimes:jpg,jpeg,png',
            'requisicion_compra' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'recibi' => 'required|string',
            'cotizaciones' => 'nullable|array',
            'cotizaciones.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'cantidad_pagada' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'fecha_compra' => 'required|date',
            'fecha_entrega' => 'required|date'
        ]);

        $data = $request->all();

        // Almacenar factura documento
        if ($request->hasFile('factura_documento')) {
            $data['factura_documento'] = $request->file('factura_documento')->store('facturas/documentos', 'public');
        }

        // Almacenar comprobante de pago
        if ($request->hasFile('comprobante_pago')) {
            $data['comprobante_pago'] = $request->file('comprobante_pago')->store('facturas/comprobantes', 'public');
        }

        // Almacenar requisición de compra
        if ($request->hasFile('requisicion_compra')) {
            $data['requisicion_compra'] = $request->file('requisicion_compra')->store('facturas/requisiciones', 'public');
        }

        // Almacenar imágenes
        if ($request->hasFile('imagenes')) {
            $imagenes = [];
            foreach ($request->file('imagenes') as $imagen) {
                $imagenes[] = $imagen->store('facturas/imagenes', 'public');
            }
            $data['imagenes'] = $imagenes;
        }

        // Almacenar cotizaciones
        if ($request->hasFile('cotizaciones')) {
            $cotizaciones = [];
            foreach ($request->file('cotizaciones') as $cotizacion) {
                $cotizaciones[] = $cotizacion->store('facturas/cotizaciones', 'public');
            }
            $data['cotizaciones'] = $cotizaciones;
        }

        $factura = Factura::create($data);
        return response()->json($factura, 201);
    }

    public function show(Factura $factura)
    {
        return response()->json($factura->load(['proveedor', 'area', 'user']));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'proveedor_id' => 'exists:proveedores,id',
            'area_id' => 'exists:areas,id',
            'user_id' => 'exists:users,id',
            'factura_documento' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'comprobante_pago' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'file|mimes:jpg,jpeg,png',
            'requisicion_compra' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'recibi' => 'string',
            'cotizaciones' => 'nullable|array',
            'cotizaciones.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'cantidad_pagada' => 'numeric',
            'fecha_pago' => 'date',
            'fecha_compra' => 'date',
            'fecha_entrega' => 'date'
        ]);

        $data = $request->all();

        // Actualizar factura documento
        if ($request->hasFile('factura_documento')) {
            // Eliminar el archivo anterior si existe
            if ($factura->factura_documento) {
                Storage::disk('public')->delete($factura->factura_documento);
            }
            $data['factura_documento'] = $request->file('factura_documento')->store('facturas/documentos', 'public');
        }

        // Actualizar comprobante de pago
        if ($request->hasFile('comprobante_pago')) {
            if ($factura->comprobante_pago) {
                Storage::disk('public')->delete($factura->comprobante_pago);
            }
            $data['comprobante_pago'] = $request->file('comprobante_pago')->store('facturas/comprobantes', 'public');
        }

        // Actualizar requisición de compra
        if ($request->hasFile('requisicion_compra')) {
            if ($factura->requisicion_compra) {
                Storage::disk('public')->delete($factura->requisicion_compra);
            }
            $data['requisicion_compra'] = $request->file('requisicion_compra')->store('facturas/requisiciones', 'public');
        }

        // Actualizar imágenes
        if ($request->hasFile('imagenes')) {
            // Eliminar imágenes anteriores
            if ($factura->imagenes) {
                foreach ($factura->imagenes as $imagen) {
                    Storage::disk('public')->delete($imagen);
                }
            }
            $imagenes = [];
            foreach ($request->file('imagenes') as $imagen) {
                $imagenes[] = $imagen->store('facturas/imagenes', 'public');
            }
            $data['imagenes'] = $imagenes;
        }

        // Actualizar cotizaciones
        if ($request->hasFile('cotizaciones')) {
            // Eliminar cotizaciones anteriores
            if ($factura->cotizaciones) {
                foreach ($factura->cotizaciones as $cotizacion) {
                    Storage::disk('public')->delete($cotizacion);
                }
            }
            $cotizaciones = [];
            foreach ($request->file('cotizaciones') as $cotizacion) {
                $cotizaciones[] = $cotizacion->store('facturas/cotizaciones', 'public');
            }
            $data['cotizaciones'] = $cotizaciones;
        }

        $factura->update($data);
        return response()->json($factura);
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return response()->json(null, 204);
    }
}