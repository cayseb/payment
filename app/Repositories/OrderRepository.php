<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Subscription;

class OrderRepository
{
    public function store(int $price, string $subscriptionId): Order
    {
        $order = new Order();
        $order->status = OrderStatusEnum::INIT->value;
        $order->amount = $price;
        $order->subscription_id = $subscriptionId;
        $order->save();

        return $order;
    }

    public function update(Order $order, array $data)
    {
        $order->update($data);

    }
}
