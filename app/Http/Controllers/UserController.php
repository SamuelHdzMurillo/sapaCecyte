<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UserController extends Controller
{
    public function store(Request $request)
{

    // Validación de los datos del formulario
    $request->validate([
        'nombre_Usuario' => 'required',
        'rol_Usuario' => 'required',
        'area_Usuario' => 'required',
        'password' => 'required|min:8',
    ]);

    // Validar los datos de entrada
    $validatedData = $request->all();

    // Encriptar la contraseña
    $validatedData['password'] = bcrypt($validatedData['password']);

    // Crear el usuario en base a los datos validados
    $user = User::create([
        
        'correo_Usuario' => $validatedData['correo_Usuario'],
        'nombre_Usuario' => $validatedData['nombre_Usuario'],
        'rol_Usuario' => $validatedData['rol_Usuario'],
        'area_Usuario' => $validatedData['area_Usuario'],
        'password' => $validatedData['password'],
        
    ]);

    // Devolver respuesta JSON
    return response()->json(['message' => 'Usuario creado con éxito.', 'data' => $user], 201);
}

public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User no encontrado'], 404);
    }

    return response()->json(['message' => 'User encontrado.', 'data' => $user]);
}

public function index()
    {
        $users = User::all();
        return response()->json(['message' => 'Todos los usarios obtenidos', 'data' => $users]);
    }

}
