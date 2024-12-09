<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //

    protected $fillable = [
        'nombre_Programa',
        'anio_Programa',
        'presupuesto_Programa',
        'idProyecto'
    ];

    public function proyectos() {

        return $this->hasMany(\App\Models\Proyect::class, 'id');

    }

    public function calcularPorcentajeAvance()
    {
        $presupuestoTotalPrograma = $this->presupuesto_Programa;

        if ($presupuestoTotalPrograma <= 0) {
            return ['error' => 'El presupuesto del programa no es válido.'];
        }

        $resultados = [];
        $totalGastadoPrograma = 0;

        foreach ($this->proyectos as $proyecto) {
            $datosProyecto = $proyecto->calcularPorcentajeAvance();
            if (isset($datosProyecto['error'])) {
                continue;
            }

            $totalGastadoPrograma += $datosProyecto['total_gastado'];

            $porcentajeProyectoDelPrograma = ($proyecto->presupuesto_Proyecto / $presupuestoTotalPrograma) * 100;
            $porcentajeGastadoDelPrograma = ($datosProyecto['total_gastado'] / $presupuestoTotalPrograma) * 100;

            $resultados[] = [
                'proyecto_id' => $proyecto->id,
                'nombre' => $proyecto->nombre_Proyecto,
                'presupuesto_proyecto' => $proyecto->presupuesto_Proyecto,
                'porcentaje_proyecto_programa' => round($porcentajeProyectoDelPrograma, 2) . '%',
                'total_gastado' => $datosProyecto['total_gastado'],
                'porcentaje_gastado_programa' => round($porcentajeGastadoDelPrograma, 2) . '%',
                'avances' => $datosProyecto['avances']
            ];
        }

        $porcentajeTotalPrograma = ($totalGastadoPrograma / $presupuestoTotalPrograma) * 100;

        return [
            'proyectos' => $resultados,
            'total_gastado_programa' => $totalGastadoPrograma,
            'porcentaje_total_programa' => round($porcentajeTotalPrograma, 2) . '%'
        ];
    }
}
