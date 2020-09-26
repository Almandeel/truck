<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if('can', function ($string) {
            // if($string == 'price-purchase-read') dd(Auth::user()->allPermissions(), Auth::user()->allPermissions()->where('name', $string)->first());
            $condition = false;

            $permissions = is_array($string) ? $string : explode('|', $string);
            foreach ($permissions as $permission) {
                $condition = \Auth::user()->allPermissions()->where('name', $permission)->first() ? true : false;
            }

            return $condition;
        });

        Schema::defaultStringLength(191);
    }
}
