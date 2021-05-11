<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Dao\TypeDao;

class TypeDaoProvider extends ServiceProvider
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
        $this->bind('TypeDao', function($app) {
            return new TypeDao();
        });
    }
}
