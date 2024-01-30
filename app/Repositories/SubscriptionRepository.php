<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\PaymentTypeEnum;
use App\Enums\SubscriptionTypeEnum;
use App\Models\Subscription;
use App\Models\Tariff;
use Illuminate\Http\Request;

class SubscriptionRepository
{
    public function store(Request $request): Subscription
    {
        //TODO $request->payment_type
        $subscription = new Subscription();
        $subscription->status = Subscription::STATUS_INIT;
        $subscription->user_id = \auth()->id();
        $subscription->payment_type = PaymentTypeEnum::from('sber');
        $subscription->tariff_id = Tariff::where('period', 1)->first()->id;
        $subscription->save();
        return $subscription;
    }

    public function update(Subscription $subscription, array $data)
    {
        $subscription->update($data);
    }

    public function updateOrCreate(PaymentTypeEnum $paymentType, SubscriptionTypeEnum $type, int $period)
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

    public function setIsActive(Subscription $subscription, bool $isActive)
    {
        $subscription->update(['is_active' => $isActive]);
    }
}
