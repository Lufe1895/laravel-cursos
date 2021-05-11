<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'all-permissions'
        ]);

        Role::create([
            'name' => 'coordinator',
            'display_name' => 'Coordinador',
            'description' => 'see-courses-and-pupils'
        ]);

        Role::create([
            'name' => 'student',
            'display_name' => 'Estudiante',
            'description' => 'see-courses'
        ]);
    }
}
