<?php

namespace Shopvel\Providers;

use Illuminate\Support\ServiceProvider;
use View, Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('options')){
            View::addLocation( base_path('resources/themes/' . get_option('theme') . '/views') );
        }
        View::addLocation( base_path('resources/views') );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
