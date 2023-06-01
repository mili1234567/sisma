<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ADMINISTRACION */
        Permission::create([
            'name' => 'Reporte_Movimientos_General',
            'areaspermissions_id' => '1',
            'descripcion' => 'Reporta el Movimiento Diario por Sucursales.',
            'guard_name' => 'web'
        ]);
       
    }
}
