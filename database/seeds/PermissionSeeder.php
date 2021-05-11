<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'see-course',
            'display_name' => 'Ver Curso',
            'description' => ''
        ]);

        Permission::create([
            'name' => 'add-course',
            'display_name' => 'Agregar Curso',
            'description' => ''
        ]);

        Permission::create([
            'name' => 'edit-course',
            'display_name' => 'Editar Curso',
            'description' => ''
        ]);

        Permission::create([
            'name' => 'delete-curse',
            'display_name' => 'Eliminar Curso',
            'description' => ''
        ]);

        Permission::create([
            'name' => 'show-all-courses',
            'display_name' => 'Mostrar todos los cursos',
            'description' => ''
        ]);
    }
}
