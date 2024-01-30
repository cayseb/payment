<?php

declare(strict_types=1);

use App\Models\Order;

class UpdateOrder
{
    private Order $order;
    private array $data;

    public function __construct(Order $order, array $data)
    {
        $this->order = $order;
        $this->data = $data;
    }

    public function __invoke(): void
    {
        $this->order->update($this->data);
    }
}
