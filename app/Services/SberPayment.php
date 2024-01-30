<?php

declare(strict_types=1);

namespace App\Services;

use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\Currency;
use Voronkovich\SberbankAcquiring\HttpClient\HttpClientInterface;

class SberPayment implements PaymentInterface
{
    private Client $client;
    private string $login;
    private string $password;
    private string $successUrl;
    private string $failUrl;

    public function __construct(
        string $login,
        string $password,
        string $successUrl,
        string $failUrl,
    )
    {
        $this->client = new Client([
            'userName' => $this->login,
            'password' => $this->password,
            'language' => 'ru',
            'currency' => Currency::RUB,
            'apiUri' => Client::API_URI_TEST,
        ]);
        $this->login = $login;
        $this->password = $password;
        $this->successUrl = $successUrl;
        $this->failUrl = $failUrl;
    }

    public function register(string $orderId, int $amount, string $clientId): array
    {
        $params = ['failUrl' => $this->failUrl, 'clientId' => $clientId];
        return $this->client->registerOrder($orderId, $amount, $this->successUrl, $params);
    }

    public function getOrderStatus(\App\Models\Order $order): array
    {
        return $this->client->getOrderStatus($order->external_id);
    }

    public function paymentOrderBinding()
    {
        // TODO: Implement paymentOrderBinding() method.
    }

}
