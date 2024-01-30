<?php

declare(strict_types=1);

namespace App\Console\Schedule;

use App\Enums\SubscriptionTypeEnum;
use App\Jobs\CheckOnceSubscriptionExpiredJob;
use App\Models\Subscription;

class CheckOnceSubscriptionExpiredSchedule
{
    public function __invoke(): void
    {
        $subscriptions = Subscription::where('type', SubscriptionTypeEnum::ONCE->value);

        foreach ($subscriptions as $subscription) {
            CheckOnceSubscriptionExpiredJob::dispatch($subscription);
        }
    }
}
