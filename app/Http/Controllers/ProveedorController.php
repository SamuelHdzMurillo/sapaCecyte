<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json([
            'status' => 'success',
            'data' => $proveedores
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'rfc' => 'required',
            'nombre_empresa' => 'required',
            'padron_proveedores' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'registro_compranet' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_sat' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'sat_cumplimiento_obligaciones' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'comprobante_domicilio' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'infonavit_constancia_fiscal' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'imss_opinion_cumplimiento' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_no_sancion' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_inhabilitacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $proveedor = new Proveedor($request->all());

        $fileFields = [
            'padron_proveedores', 'registro_compranet', 'constancia_sat',
            'sat_cumplimiento_obligaciones', 'comprobante_domicilio',
            'infonavit_constancia_fiscal', 'imss_opinion_cumplimiento',
            'constancia_no_sancion', 'constancia_inhabilitacion'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->storeAs('proveedores', $filename, 'public');
                $proveedor->$field = $filename;
            }
        }

        $proveedor->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Proveedor created successfully',
            'data' => $proveedor
        ], 201);
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        
        if (!$proveedor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proveedor not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $proveedor
        ]);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        
        if (!$proveedor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proveedor not found'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required',
            'rfc' => 'required',
            'nombre_empresa' => 'required',
            'padron_proveedores' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'registro_compranet' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_sat' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'sat_cumplimiento_obligaciones' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'comprobante_domicilio' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'infonavit_constancia_fiscal' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'imss_opinion_cumplimiento' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_no_sancion' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'constancia_inhabilitacion' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $proveedor->fill($request->except([
            'padron_proveedores', 'registro_compranet', 'constancia_sat',
            'sat_cumplimiento_obligaciones', 'comprobante_domicilio',
            'infonavit_constancia_fiscal', 'imss_opinion_cumplimiento',
            'constancia_no_sancion', 'constancia_inhabilitacion'
        ]));

        $fileFields = [
            'padron_proveedores', 'registro_compranet', 'constancia_sat',
            'sat_cumplimiento_obligaciones', 'comprobante_domicilio',
            'infonavit_constancia_fiscal', 'imss_opinion_cumplimiento',
            'constancia_no_sancion', 'constancia_inhabilitacion'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                if ($proveedor->$field) {
                    Storage::disk('public')->delete('proveedores/' . $proveedor->$field);
                }
                
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->storeAs('proveedores', $filename, 'public');
                $proveedor->$field = $filename;
            }
        }

        $proveedor->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Proveedor updated successfully',
            'data' => $proveedor
        ]);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        
        if (!$proveedor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proveedor not found'
            ], 404);
        }

        $fileFields = [
            'padron_proveedores', 'registro_compranet', 'constancia_sat',
            'sat_cumplimiento_obligaciones', 'comprobante_domicilio',
            'infonavit_constancia_fiscal', 'imss_opinion_cumplimiento',
            'constancia_no_sancion', 'constancia_inhabilitacion'
        ];

        foreach ($fileFields as $field) {
            if ($proveedor->$field) {
                Storage::disk('public')->delete('proveedores/' . $proveedor->$field);
            }
        }

        $proveedor->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Proveedor deleted successfully'
        ]);
    }
}
