<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Activo',
            'description' => 'El curso está disponible'
        
        ]);
        Status::create([
            'name' => 'Inactivo',
            'description' => 'El curso no está disponible'
        ]);
        Status::create([
            'name' => 'Lleno',
            'description' => 'No hay espacio para más participantes'
        ]);
        Status::create([
            'name' => 'Suspendido',
            'description' => 'El curso se reanudará pronto'
        ]);
        Status::create([
            'name' => 'Cancelado',
            'description' => 'El curso ya no estará disponible'
        ]);
    }
}
