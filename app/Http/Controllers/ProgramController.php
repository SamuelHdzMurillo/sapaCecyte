<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    // Obtener todos los programas
    public function index()
    {
        $programs = Program::all();
        return response()->json(['data' => $programs]);
    }

    // Crear un nuevo programa
    public function store(Request $request)
    {
        $request->validate([
            'nombre_Programa' => 'required|string',
            'anio_Programa' => 'required|string',
            'presupuesto_Programa' => 'required|integer',
            'idProyecto' => 'required|exists:proyects,id', // Asegúrate de tener la tabla 'projects'
        ]);

        $program = Program::create($request->all());

        return response()->json(['message' => 'Programa creado con éxito', 'data' => $program], 201);
    }

    // Mostrar un programa específico
    public function show($id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        return response()->json(['data' => $program]);
    }

    // Actualizar un programa
    public function update(Request $request, $id)
{
    // Buscar el programa por ID
    $program = Program::find($id);

    // Verificar si el programa existe
    if (!$program) {
        return response()->json(['message' => 'Programa no encontrado'], 404);
    }

    // Validar los datos recibidos
    $validatedData = $request->validate([
        'nombre_Programa' => 'string',
        'anio_Programa' => 'string',
        'presupuesto_Programa' => 'integer',
        'idProyecto' => 'exists:proyects,id',
    ]);

    // Actualizar campos de forma individual
    $program->nombre_Programa = $request->input('nombre_Programa', $program->nombre_Programa);
    $program->anio_Programa = $request->input('anio_Programa', $program->anio_Programa);
    $program->presupuesto_Programa = $request->input('presupuesto_Programa', $program->presupuesto_Programa);
    $program->idProyecto = $request->input('idProyecto', $program->idProyecto);

    // Guardar los cambios
    try {
        $program->save();
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar el programa', 'error' => $e->getMessage()], 500);
    }

    return response()->json(['message' => 'Programa actualizado con éxito', 'data' => $program]);
}


    // Eliminar un programa
    public function destroy($id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Programa no encontrado'], 404);
        }

        $program->delete();

        return response()->json(['message' => 'Programa eliminado con éxito']);
    }
}
