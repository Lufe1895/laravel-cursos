<?php

use Illuminate\Database\Seeder;
use App\Models\Tutor;

class TutorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tutor::create([
            'name' => 'Luis Fernando',
            'academic_profile' => 'Ingeniero de Software'
        ]);

        Tutor::create([
            'name' => 'Vaquita',
            'academic_profile' => 'Ingeniero vacuno'
        ]);

        Tutor::create([
            'name' => 'Cabecita de Algodón',
            'academic_profile' => 'Emperador Macuspano'
        ]);
    }
}
