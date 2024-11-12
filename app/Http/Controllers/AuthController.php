<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = $request->only('correo_Usuario', 'password');


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token de acceso' => $token], 200);
        } else {
            return response()->json(['error' => 'acceso denegado'], 401);
        }
    }
}
