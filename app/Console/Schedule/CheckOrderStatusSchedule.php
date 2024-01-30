<?php

declare(strict_types=1);

namespace App\Console\Schedule;

use App\Enums\OrderStatusEnum;
use App\Helpers\PaymentHelper;
use App\Jobs\CheckSberOrderStatusJob;
use App\Models\Order;

class CheckOrderStatusSchedule
{
    public function __invoke(): void
    {
        $orders = Order::where('status', OrderStatusEnum::CREATED->value)->get();

        // TODO будет switch

        foreach ($orders as $order) {
            CheckSberOrderStatusJob::dispatch($order);
        }
    }
}
