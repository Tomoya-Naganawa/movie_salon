<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Blade;

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
    public function boot(UrlGenerator $url)
    {
        Schema::defaultStringLength(191);

        $url->forceScheme('https');

        Blade::directive('invalid', function ($name) {
            return '<?php
                if ($errors->has('.$name.')) {
                   echo "is-invalid";
                } else {
                    echo "";
                }
            ?>';
        });
    }
}
