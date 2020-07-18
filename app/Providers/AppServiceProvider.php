<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\ClientEmail;
use App\Models\ClientPhone;
use App\Observers\ClientEmailObserver;
use App\Observers\ClientObserver;
use App\Observers\ClientPhoneObserver;
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
        Client::observe(ClientObserver::class);
        ClientEmail::observe(ClientEmailObserver::class);
        ClientPhone::observe(ClientPhoneObserver::class);
    }
}
