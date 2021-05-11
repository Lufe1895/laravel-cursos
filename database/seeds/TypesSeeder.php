<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Taller',
            'description' => ''
        ]);

        Type::create([
            'name' => 'Curso',
            'description' => ''
        ]);

        Type::create([
            'name' => 'Seminario',
            'description' => ''
        ]);
    }
}
