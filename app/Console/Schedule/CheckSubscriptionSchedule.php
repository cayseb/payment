<?php

declare(strict_types=1);

namespace App\Console\Schedule;

use App\Jobs\CheckSubscriptionJob;
use App\Models\Subscription;

class CheckSubscriptionSchedule
{
    public function __invoke()
    {
        $subscriptions = Subscription::all();

        foreach ($subscriptions as $subscription){
            $payment = \PaymentHelper::getPaymentFactory($subscription->user->payment_type)->createPayment();
            $job = new CheckSubscriptionJob($subscription);
            $job->handle($payment);
        }
    }
}
