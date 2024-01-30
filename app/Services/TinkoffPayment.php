<?php

declare(strict_types=1);

namespace App\Services;


class TinkoffPayment implements PaymentInterface
{
    private TinkoffClient $client;

    public function __construct(TinkoffClient $client)
    {
        $this->client = $client;
    }

    public function register(string $orderId, int $amount, string $successUrl, array $params): array
    {
        return $this->client->init($orderId,$amount,$successUrl,$params);
    }

    public function getOrderStatus(\App\Models\Order $order): array
    {
        // TODO: Implement getOrderStatus() method.
    }

    public function paymentOrderBinding()
    {
        // TODO: Implement paymentOrderBinding() method.
    }
}
