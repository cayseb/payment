<?php

declare(strict_types=1);
namespace App\Actions\Order;
use App\Enums\OrderStatusEnum;
use App\Models\Order;

class StoreOrder
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
}
