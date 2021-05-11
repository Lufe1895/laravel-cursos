<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->truncateTables([
            'courses',
            'studies',
            'ocupations',
            'permissions',
            'roles'
        ]);

        $this->call(StudiesSeeder::class);
        $this->call(OcupationsSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(TutorsSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(UsersSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach($tables as $table){
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
