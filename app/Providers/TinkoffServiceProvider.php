<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use TinkoffClient;

class TinkoffServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TinkoffClient::class, function () {
            $config = config('bank.tinkoff');
            return new TinkoffClient(
                $config['terminalKey'],
                $config['secretKey'],
                $config['api_url'],
            );
        });
    }
}
