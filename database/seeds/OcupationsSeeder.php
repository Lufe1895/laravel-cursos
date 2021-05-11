<?php

use Illuminate\Database\Seeder;
use App\Models\Ocupation;

class OcupationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ocupation::create([
            'ocupation_name' => 'Estudiante'
        ]);
        Ocupation::create([
            'ocupation_name' => 'Ama de Casa'
        ]);
        Ocupation::create([
            'ocupation_name' => 'Trabajador'
        ]);
    }
}
