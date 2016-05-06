<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PublicPathServieProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         if (env('PUBLIC_PATH') !== NULL) {

         //An example that demonstrates setting Laravel's public path.
        $this->app['path.public'] = base_path().'/../'.env('PUBLIC_PATH');
        }
        else
        {
         $this->app['path.public'] = base_path().'/../public_html';
        }
    }
}
