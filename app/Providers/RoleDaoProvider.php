<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Dao\RoleDao;

class RoleDaoProvider extends ServiceProvider
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
        $this->bind('RoleDao', function($app) {
            return new RoleDao();
        });
    }
}
