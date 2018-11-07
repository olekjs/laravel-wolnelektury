<?php
namespace Olekjs\Wolnelektury;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wolnelektury', function() {
            return new Classes\Manage();
        });
    }
}