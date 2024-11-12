<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avance;

class AvanceController extends Controller
{
     // Listar todos los avances
     public function index()
{
    $avances = Avance::with('proyecto')->get();
    
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
             'proyecto_id' => 'required|exists:proyects,id'
         ]);
 
         $avance = Avance::create($validatedData);
         return response()->json(['message' => 'Avance creado con éxito', 'data' => $avance], 201);
     }
 
     // Mostrar un avance específico
     public function show($id)
{
    $proyecto = Proyecto::with('avances')->find($id);

    if (!$proyecto) {
        return response()->json(['message' => 'Proyecto no encontrado'], 404);
    }

    return response()->json(['data' => $proyecto]);
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
             'proyecto_id' => 'exists:proyects,id'
         ]);
 
         $avance->update($validatedData);
         return response()->json(['message' => 'Avance actualizado con éxito', 'data' => $avance]);
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
