<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('isAdmin', function () {
            return $this->getHost() === admin_url();
        });

        Carbon::macro('formatted', function ($format = 'd-M-Y') {
            return $this->format($format);
        });

        config(['app.timezone' => ip_info('timezone', 'UTC')]);
        date_default_timezone_set(config('app.timezone'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
