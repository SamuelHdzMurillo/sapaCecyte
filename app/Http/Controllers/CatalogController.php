<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Proyect;
use App\Models\Area;

class CatalogController extends Controller
{
    public function getPrograms()
    {
        $programs = Program::all();
        return response()->json(['data' => $programs]);
    }

    public function getProyects()
    {
        $proyectos = Proyect::select('id', 'nombre_proyecto')->get();
        return response()->json(['data' => $proyectos]);
    }


    public function getAreas()
    {
        $areas = Area::all();
        return response()->json(['data' => $areas], 200);
    }
}
