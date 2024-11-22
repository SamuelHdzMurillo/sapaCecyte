<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectHasArea;

class ProyectHasAreaController extends Controller
{
    /**
     * List all entries in the proyecto_has_area table.
     */
    public function index()
    {
        $proyectosAreas = ProyectHasArea::join('areas', 'proyecto_has_area.idArea', '=', 'areas.id')
            ->join('proyects', 'proyecto_has_area.idProyecto', '=', 'proyects.id')
            ->select('proyecto_has_area.id', 'areas.nombre_Area as area', 'proyects.nombre_Proyecto as proyecto')
            ->get();

        return response()->json($proyectosAreas);
    }

    /**
     * Store a new entry in the proyecto_has_area table.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idArea' => 'required|exists:areas,id',
            'idProyecto' => 'required|exists:proyects,id',
        ]);

        ProyectHasArea::create([
            'idArea' => $request->idArea,
            'idProyecto' => $request->idProyecto,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Relacion creada correctamente.']);
    }

    /**
     * Show a single entry in the proyecto_has_area table.
     */
    public function show($id)
    {
        $proyectoArea = ProyectHasArea::where('proyecto_has_area.id', $id)
            ->join('areas', 'proyecto_has_area.idArea', '=', 'areas.id')
            ->join('proyects', 'proyecto_has_area.idProyecto', '=', 'proyects.id')
            ->select('proyecto_has_area.id', 'areas.nombre_Area as area', 'proyects.nombre_Proyecto as proyecto')
            ->first();

        if (!$proyectoArea) {
            return response()->json(['message' => 'Relacion no encontrada.'], 404);
        }

        return response()->json($proyectoArea);
    }

    /**
     * Update an entry in the proyecto_has_area table.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'idArea' => 'required|exists:areas,id',
            'idProyecto' => 'required|exists:proyects,id',
        ]);

        $updated = ProyectHasArea::where('id', $id)
            ->update([
                'idArea' => $request->idArea,
                'idProyecto' => $request->idProyecto,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return response()->json(['message' => 'No se pudo actualizar la relacion.'], 400);
        }

        return response()->json(['message' => 'Relacion actualizada correctamente.']);
    }

    /**
     * Delete an entry from the proyecto_has_area table.
     */
    public function destroy($id)
    {
        $deleted = ProyectHasArea::where('id', $id)->delete();

        if (!$deleted) {
            return response()->json(['message' => 'No se pudo eliminar la relacion.'], 400);
        }

        return response()->json(['message' => 'Relacion eliminada correctamente.']);
    }
}