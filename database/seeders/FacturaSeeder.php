<?php

namespace Database\Seeders;

use App\Models\Factura;
use App\Models\Proveedor;
use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    public function run()
    {
        // Check if we have the necessary related data
        $proveedorIds = Proveedor::pluck('id')->toArray();
        $areaIds = Area::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        // Verify if we have the necessary data
        if (empty($proveedorIds) || empty($areaIds) || empty($userIds)) {
            echo "Please ensure Proveedores, Areas, and Users tables have data before running this seeder.\n";
            return;
        }

        // Create 10 sample facturas
        for ($i = 0; $i < 10; $i++) {
            Factura::create([
                'proveedor_id' => $proveedorIds[array_rand($proveedorIds)],
                'area_id' => $areaIds[array_rand($areaIds)],
                'user_id' => $userIds[array_rand($userIds)],
                'factura_documento' => 'sample_factura_' . ($i + 1) . '.pdf',
                'comprobante_pago' => 'sample_comprobante_' . ($i + 1) . '.pdf',
                'imagenes' => [
                    'imagen1_' . ($i + 1) . '.jpg',
                    'imagen2_' . ($i + 1) . '.jpg'
                ],
                'requisicion_compra' => 'sample_requisicion_' . ($i + 1) . '.pdf',
                'recibi' => 'sample_recibi_' . ($i + 1) . '.pdf',
                'cotizaciones' => [
                    'cotizacion1_' . ($i + 1) . '.pdf',
                    'cotizacion2_' . ($i + 1) . '.pdf'
                ],
                'cantidad_pagada' => fake()->randomFloat(2, 1000, 50000),
                'fecha_pago' => fake()->dateTimeBetween('-1 month', 'now'),
                'fecha_compra' => fake()->dateTimeBetween('-2 months', '-1 month'),
                'fecha_entrega' => fake()->dateTimeBetween('-1 month', '+1 month'),
            ]);
        }
    }
}