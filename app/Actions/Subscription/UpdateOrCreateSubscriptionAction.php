<?php

declare(strict_types=1);

namespace App\Actions\Subscription;

use App\Enums\PaymentTypeEnum;
use App\Enums\SubscriptionTypeEnum;
use App\Models\Subscription;
use App\Models\Tariff;

class UpdateOrCreateSubscriptionAction
{
    public function updateOrCreate(PaymentTypeEnum $paymentType, SubscriptionTypeEnum $type, int $period): Subscription
    {
        return Subscription::updateOrCreate(
            ['id' => auth()->user()->subscription->id],
            [
                'payment_type' => $paymentType->value,
                'type' => $type,
                'user_id' => auth()->id(),
                'tariff_id' => Tariff::where('period', $period)->first()->id,
            ]
        );
    }
}
