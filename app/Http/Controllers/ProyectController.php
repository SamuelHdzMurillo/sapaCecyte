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

    public function mostrarPresupuesto($id)
{
    $proyecto = Proyect::with('avances')->find($id);

    if (!$proyecto) {
        return response()->json(['error' => 'Proyecto no encontrado'], 404);
    }

    $datosPresupuesto = $proyecto->calcularPorcentajeAvance();

    if (isset($datosPresupuesto['error'])) {
        return response()->json(['error' => $datosPresupuesto['error']], 400);
    }

    return response()->json([
        'proyecto' => [
            'id' => $proyecto->id,
            'nombre' => $proyecto->nombre_Proyecto,
            'presupuesto_total' => $proyecto->presupuesto_Proyecto,
        ],
        'datos_presupuesto' => $datosPresupuesto
    ]);
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

 
    public function calcularPorcentajeAvance($proyectoId)
{
    // Buscar el proyecto por ID, sin cargar todos los avances
    $proyecto = Proyect::find($proyectoId);

    // Validar que el proyecto exista
    if (!$proyecto) {
        return response()->json(['error' => 'Proyecto no encontrado.'], 404);
    }

    // Calcular el porcentaje de avance usando el método en el modelo
    $resultado = $proyecto->calcularPorcentajeAvance();

    // Verificar si hubo algún error en el cálculo
    if (isset($resultado['error'])) {
        return response()->json(['error' => $resultado['error']], 400);
    }

    // Validar que los valores sean numéricos
    $presupuestoTotal = is_numeric($proyecto->presupuesto_Proyecto) ? $proyecto->presupuesto_Proyecto : 0;
    $totalGastado = is_numeric($resultado['total_gastado']) ? $resultado['total_gastado'] : 0;

    if ($presupuestoTotal <= 0) {
        return response()->json(['error' => 'El presupuesto total no es válido.'], 400);
    }

    // Calcular cuánto falta por gastar y el porcentaje restante
    $faltante = $presupuestoTotal - $totalGastado;
    $porcentajeFaltante = 100 - (($totalGastado / $presupuestoTotal) * 100);

    // Agregar los datos faltantes y el nombre del proyecto al resultado
    $resultado['nombre_Proyecto'] = $proyecto->nombre; // Asegúrate de que el campo sea correcto
    $resultado['faltante'] = $faltante;
    $resultado['porcentaje_faltante'] = round($porcentajeFaltante, 2) . '%';

    // Devolver el resultado en formato JSON
    return response()->json($resultado);
}

    
}


