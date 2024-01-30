<?php

declare(strict_types=1);
namespace App\Services;


class AlfaPayment implements PaymentInterface
{

    public function register(string $orderId, int $amount, string $returnUrl, array $params): array
    {
        // TODO: Implement register() method.
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
