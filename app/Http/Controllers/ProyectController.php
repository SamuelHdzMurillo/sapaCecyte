<?php

namespace App\Http\Controllers;
use App\Models\Proyect;

use Illuminate\Http\Request;

class ProyectController extends Controller
{   
    // Método para listar todos los proyectos
    public function index()
    {
        $proyectos = Proyect::with('avances')->get();
        return response()->json(['data' => $proyectos]);
    }

    // Método para crear un nuevo proyecto
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $validatedData = $request->validate([
            'nombre_Proyecto' => 'required|string|max:255',
            'descripcion_Proyecto' => 'nullable|string',
            'presupuesto_Proyecto' => 'required|numeric',
            'fechaInicio_Proyecto' => 'required|date',
            'fechaFin_Proyecto' => 'required|date|after_or_equal:fechaInicio_Proyecto',
            'comentario_Proyecto' => 'nullable|string',
            'idAvance' => 'nullable|string'
        ]);

        // Crear el proyecto
        $proyect = Proyect::create($validatedData);

        return response()->json(['message' => 'Proyecto creado con éxito', 'data' => $proyect], 201);
    }

    // Método para obtener un proyecto específico
    public function show($id)
    {
        $proyect = Proyect::with('avances')->find($id);

        if (!$proyect) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        return response()->json(['data' => $proyect]);
    }

    // Método para actualizar un proyecto
    public function update(Request $request, $id)
    {
        $proyect = Proyect::find($id);

        if (!$proyect) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre_Proyecto' => 'string|max:255',
            'descripcion_Proyecto' => 'nullable|string',
            'presupuesto_Proyecto' => 'numeric',
            'fechaInicio_Proyecto' => 'date',
            'fechaFin_Proyecto' => 'date|after_or_equal:fechaInicio_Proyecto',
            'comentario_Proyecto' => 'nullable|string',
            'idAvance' => 'exists:avances,id'
        ]);

        $proyect->update($validatedData);

        return response()->json(['message' => 'Proyecto actualizado con éxito', 'data' => $proyect]);
    }

    // Método para eliminar un proyecto
    public function destroy($id)
    {
        $proyect = Proyect::find($id);

        if (!$proyect) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }

        $proyect->delete();

        return response()->json(['message' => 'Proyecto eliminado con éxito']);
    }
}


