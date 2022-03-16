<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Service;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer(
            'layouts.client_template',
            function ($view) {
                $information = Company::all();
                $services = Service::all();
                $view->with('information', $information)->with('services', $services);
            }
        );
    }
}
