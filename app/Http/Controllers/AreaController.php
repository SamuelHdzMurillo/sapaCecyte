<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Muestra una lista de todas las áreas.
     */
    public function index()
    {
        $areas = Area::all();
        return response()->json(['message' => 'Áreas obtenidas correctamente', 'data' => $areas], 200);
    }

    /**
     * Almacena una nueva área.
     */
    public function store(Request $request)
    {
        $request->validate([
            'encargado_Area' => 'required|string',
            'nombre_Area' => 'required|string',
            'idProyecto' => 'required|exists:proyects,id', // Verifica que el proyecto exista
        ]);

        $area = Area::create($request->all());

        return response()->json(['message' => 'Área creada con éxito', 'data' => $area], 201);
    }

    /**
     * Muestra una área específica.
     */
    public function show($id)
{
    // Buscar el área por ID, incluyendo todos los proyectos relacionados
    $area = Area::with('proyectos')->find($id);

    if (!$area) {
        return response()->json(['message' => 'Área no encontrada'], 404);
    }

    // Estructurar la respuesta JSON para mostrar el área y todos sus proyectos
    return response()->json([
        'message' => 'Área encontrada',
        'area' => [
            'id' => $area->id,
            'encargado' => $area->encargado_Area,
            'nombre' => $area->nombre_Area,
            'proyectos' => $area->proyectos // Aquí debería mostrar todos los proyectos asociados
        ]
    ], 200);
}

    

    
    

    /**
     * Actualiza una área existente.
     */
    public function update(Request $request, $id)
    {
        // Buscar el área por ID
        $area = Area::find($id);

        // Verificar si el área existe
        if (!$area) {
            return response()->json(['message' => 'El área no existe'], 404);
        }

        // Actualizar campos
        $area->encargado_Area = $request->input('encargado_Area', $area->encargado_Area);
        $area->nombre_Area = $request->input('nombre_Area', $area->nombre_Area);
        $area->idProyecto = $request->input('idProyecto', $area->idProyecto);

        // Guardar los cambios
        try {
            $area->save();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el área', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Área actualizada correctamente']);
    }
    
    /**
     * Elimina una área.
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        $area->delete();

        return response()->json(['message' => 'Área eliminada con éxito'], 200);
    }
}
