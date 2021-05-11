<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Dao\PermissionDao;

class PermissionDaoProvider extends ServiceProvider
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
        $this->bind('PermissionDao', function($app) {
            return new PermissionDao();
        });
    }
}
