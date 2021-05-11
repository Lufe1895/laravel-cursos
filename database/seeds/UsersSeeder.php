<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use App\Models\Role;
use App\Models\Course;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Usuario Administrador
         */
        $role = Role::where('name', '=', 'admin')->first();
        $course = Course::find(1);

        $user = User::create([
            'name' => 'Admin Istrador',
            'last_name' => 'Si Gi',
            'email' => 'admin@example.com',
            'api_token' => Str::random(60),
            'password' => Hash::make('12345678'),
            'phone_number' => '1234567890',
            'city' => 'Oaxaca',
            'age' => 25,
            'sex' => 'M',
            'ocupation_id' => 1,
            'study_id' =>2,
            'image' => '/usuariosImg/1/image.png',
        ]);

        $user->attachRole($role);
        $user->courses()->attach($course);
        $course = Course::find(2);
        $user->courses()->attach($course);
        $course = Course::find(1);

        /**
         * Usuario Coordinador
         */

        $role = Role::where('name', '=', 'coordinator')->first();

        $user = User::create([
            'name' => 'Coordi Nador',
            'last_name' => 'Si Gi',
            'email' => 'cordi@example.com',
            'api_token' => Str::random(60),
            'password' => Hash::make('12345678'),
            'phone_number' => '1234567890',
            'city' => 'Oaxaca',
            'age' => 25,
            'sex' => 'M',
            'ocupation_id' => 1,
            'study_id' =>2,
            'image' => '/usuariosImg/2/image.jpg',
        ]);

        $user->attachRole($role);
        $user->courses()->attach($course);

        /**
         * Usuario Estudiante
         */

        $role = Role::where('name', '=', 'student')->first();

        $user = User::create([
            'name' => 'Estu Diante',
            'last_name' => 'Si Gi',
            'email' => 'estudiante@example.com',
            'api_token' => Str::random(60),
            'password' => Hash::make('12345678'),
            'phone_number' => '1234567890',
            'city' => 'Oaxaca',
            'age' => 25,
            'sex' => 'M',
            'ocupation_id' => 1,
            'study_id' =>2,
            'image' => '/usuariosImg/3/image.jpg',
        ]);

        $user->attachRole($role);
        $user->courses()->attach($course);
    }
}
