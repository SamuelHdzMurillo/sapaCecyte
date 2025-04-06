<?php

namespace Database\Seeders;

use App\Models\Factura;
use App\Models\Proveedor;
use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FacturaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('es_MX');

        // Check if we have the necessary related data
        $proveedorIds = Proveedor::pluck('id')->toArray();
        $areaIds = Area::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        // Verify if we have the necessary data
        if (empty($proveedorIds) || empty($areaIds) || empty($userIds)) {
            echo "Por favor asegúrate de que las tablas de Proveedores, Áreas y Usuarios tengan datos antes de ejecutar este seeder.\n";
            return;
        }

        // Tipos de documentos comunes
        $extensiones = ['pdf', 'jpg', 'png'];

        // Create 20 sample facturas
        for ($i = 0; $i < 20; $i++) {
            // Generar fechas en orden lógico
            $fechaCompra = $faker->dateTimeBetween('-6 months', '-2 months');
            $fechaEntrega = $faker->dateTimeBetween($fechaCompra, '+1 month');
            $fechaPago = $faker->dateTimeBetween($fechaEntrega, $fechaEntrega->format('Y-m-d') . ' +15 days');

            $cantidadPagada = $faker->randomFloat(2, 1000, 150000);

            Factura::create([
                'proveedor_id' => $faker->randomElement($proveedorIds),
                'area_id' => $faker->randomElement($areaIds),
                'user_id' => $faker->randomElement($userIds),
                'factura_documento' => $faker->uuid . '.' . $faker->randomElement($extensiones),
                'comprobante_pago' => $faker->uuid . '.' . $faker->randomElement($extensiones),
                'imagenes' => [
                    $faker->uuid . '.' . $faker->randomElement($extensiones),
                    $faker->uuid . '.' . $faker->randomElement($extensiones),
                    $faker->uuid . '.' . $faker->randomElement($extensiones)
                ],
                'requisicion_compra' => 'REQ-' . str_pad($faker->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT) . '.' . $faker->randomElement($extensiones),
                'recibi' => 'REC-' . str_pad($faker->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT) . '.' . $faker->randomElement($extensiones),
                'cotizaciones' => [
                    'COT-' . str_pad($faker->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT) . '.' . $faker->randomElement($extensiones),
                    'COT-' . str_pad($faker->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT) . '.' . $faker->randomElement($extensiones)
                ],
                'cantidad_pagada' => $cantidadPagada,
                'fecha_pago' => $fechaPago,
                'fecha_compra' => $fechaCompra,
                'fecha_entrega' => $fechaEntrega
            ]);
        }

        echo "Se han creado 20 facturas de ejemplo exitosamente.\n";
    }
}
