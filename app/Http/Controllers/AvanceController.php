<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avance;
use App\Models\Factura;

class AvanceController extends Controller
{
     // Listar todos los avances
     public function index()
     {
         $avances = Avance::with(['proyecto', 'facturas'])->get();
         return response()->json(['data' => $avances]);
     }
 
     // Crear un nuevo avance
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'costo_Avance' => 'required|numeric',
             'fecha_Avance' => 'required|date',
             'descripcion_Avance' => 'nullable|string',
             'evidencia_Avance' => 'nullable|string',
             'proyecto_id' => 'required|exists:proyects,id',
             'facturas' => 'sometimes|array',
             'facturas.*' => 'sometimes|exists:facturas,id'
         ]);
 
         $avance = Avance::create($validatedData);
 
         if (isset($validatedData['facturas']) && !empty($validatedData['facturas'])) {
             $avance->facturas()->attach($validatedData['facturas']);
         }
 
         return response()->json(['message' => 'Avance creado con éxito', 'data' => $avance->load('facturas')], 201);
     }
 
     // Mostrar un avance específico
     public function show($id)
     {
         $avance = Avance::with(['proyecto', 'facturas'])->find($id);
 
         if (!$avance) {
             return response()->json(['message' => 'Avance no encontrado'], 404);
         }
 
         return response()->json(['data' => $avance]);
     }
 
     // Actualizar un avance
     public function update(Request $request, $id)
     {
         $avance = Avance::find($id);
         if (!$avance) {
             return response()->json(['message' => 'Avance no encontrado'], 404);
         }
 
         $validatedData = $request->validate([
             'costo_Avance' => 'numeric',
             'fecha_Avance' => 'date',
             'descripcion_Avance' => 'nullable|string',
             'evidencia_Avance' => 'nullable|string',
             'proyecto_id' => 'exists:proyects,id',
             'facturas' => 'sometimes|array',
             'facturas.*' => 'sometimes|exists:facturas,id'
         ]);
 
         $avance->update($validatedData);
 
         if (isset($validatedData['facturas'])) {
             $avance->facturas()->sync($validatedData['facturas']);
         }
 
         return response()->json(['message' => 'Avance actualizado con éxito', 'data' => $avance->load('facturas')]);
     }
 
     // Eliminar un avance
     public function destroy($id)
     {
         $avance = Avance::find($id);
         if (!$avance) {
             return response()->json(['message' => 'Avance no encontrado'], 404);
         }
 
         $avance->delete();
         return response()->json(['message' => 'Avance eliminado con éxito']);
     }
}
