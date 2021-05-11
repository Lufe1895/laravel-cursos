<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'course_name' => 'VueJS',
            'start_date' => '2020-05-17',
            'finish_date' => '2020-05-20',
            'hours' => 15,
            'description' => 'Curso de VueJS de 15 horas',
            'status_id' => 1,
            'type_id' => 2,
            'tutor_id' => 3,
            'image' => '/cursosImg/1/image.jpg'
        ]);
        Course::create([
            'course_name' => 'NodeJS',
            'start_date' => '2020-05-17',
            'finish_date' => '2020-05-23',
            'hours' => 5,
            'description' => 'Curso de NodeJS de 15 horas',
            'status_id' => 1,
            'type_id' => 2,
            'tutor_id' => 1,
            'image' => '/cursosImg/2/image.jpg'
        ]);
        Course::create([
            'course_name' => 'Ajax',
            'start_date' => '2021-05-17',
            'finish_date' => '2021-05-20',
            'hours' => 10,
            'description' => 'Curso de Ajax de 10 horas',
            'status_id' => 1,
            'type_id' => 1,
            'tutor_id' => 1,
            'image' => '/cursosImg/3/image.jpg'
        ]);
        Course::create([
            'course_name' => 'Express',
            'start_date' => '2020-02-20',
            'finish_date' => '2020-02-25',
            'hours' => 20,
            'description' => 'Curso de Express de 20 horas',
            'status_id' => 1,
            'type_id' => 2,
            'tutor_id' => 2,
            'image' => '/cursosImg/4/image.jpg'
        ]);
    }
}
