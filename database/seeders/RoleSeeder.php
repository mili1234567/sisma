<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1= Role::create(['name'=>'Administrator']);
        $role2= Role::create(['name'=>'cajero']);

        
        permission::create(['name'=>'users.create'])->assignRole([$role1,$role2]);
        permission::create(['name'=>'users.edit'])->assignRole([$role1,$role2]);
        permission::create(['name'=>'users.destroy'])->assignRole([$role1,$role2]);
    }
}
