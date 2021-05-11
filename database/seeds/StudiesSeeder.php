<?php

use Illuminate\Database\Seeder;
use App\Models\Study;

class StudiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Study::create([
            'study_level' => 'Básico'
        ]);
        Study::create([
            'study_level' => 'Media Superior'
        ]);
        Study::create([
            'study_level' => 'Superior'
        ]);
    }
}
