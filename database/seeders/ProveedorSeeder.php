<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'Juan Pérez',
            'rfc' => 'PERJ800101ABC',
            'nombre_empresa' => 'Suministros Industriales S.A. de C.V.',
            'padron_proveedores' => 'padron_123.pdf',
            'registro_compranet' => 'compranet_123.pdf',
            'constancia_sat' => 'constancia_123.pdf',
        ]);

        Proveedor::create([
            'nombre' => 'María González',
            'rfc' => 'GONM850505XYZ',
            'nombre_empresa' => 'Servicios Técnicos Especializados S.A.',
            'padron_proveedores' => 'padron_456.pdf',
            'registro_compranet' => 'compranet_456.pdf',
            'constancia_sat' => 'constancia_456.pdf',
        ]);
    }
}
