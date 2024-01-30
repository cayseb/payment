<?php
declare(strict_types=1);

namespace App\Services;

interface PaymentInterface
{
    //public function register(string $orderId, int $amount, string $returnUrl, array $params): array;
    public function register(string $orderId, int $amount, string $clientId): array;

    public function getOrderStatus(\App\Models\Order $order): array;

    public function paymentOrderBinding();
}
