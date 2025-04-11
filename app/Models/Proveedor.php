<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    
    protected $fillable = [
        'nombre',
        'rfc',
        'nombre_empresa',
        'padron_proveedores',
        'registro_compranet',
        'constancia_sat',
        'sat_cumplimiento_obligaciones',
        'comprobante_domicilio',
        'infonavit_constancia_fiscal',
        'imss_opinion_cumplimiento',
        'constancia_no_sancion',
        'constancia_inhabilitacion'
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
