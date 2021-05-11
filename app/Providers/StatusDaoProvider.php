<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Dao\StatusDao;

class StatusDaoProvider extends ServiceProvider
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
        $this->bind('StatusDao', function($app) {
            return new StatusDao();
        });
    }
}
