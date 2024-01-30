<?php

namespace App\Providers;

use App\Services\SberPayment;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SberPayment::class, function () {

            return new SberPayment(
                config('bank.sber.login'),
                config('bank.sber.password'),
                config('bank.successUrl'),
                config('bank.failUrl'),
            );
        });
    }
}
