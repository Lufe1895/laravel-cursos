<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Dao\CourseDao;

class CourseDaoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bind('CourseDao', function($app) {
            return new CourseDao();
        });
    }
}
