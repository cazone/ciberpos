<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roleAdmin = Role::create(['name'=> 'Root']);
      $roleAdmin = Role::create(['name'=> 'Admin']);
      $roleNormal = Role::create(['name'=> 'Normal']);

  

    }
}
