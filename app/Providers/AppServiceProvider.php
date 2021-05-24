<?php

namespace App\Providers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
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

        Carbon::macro('formatted', function ($both = false, $date = 'd-M-Y', $time = 'h:i A') {
            return $this->timezone(config('app.timezone'))->format($both ? "$date $time" : $date);
        });

        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.user', function ($view) {
            $view->with('notice', Notice::query()->latest('id')->firstOrNew());
        });
    }
}
