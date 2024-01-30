<?php

declare(strict_types=1);

namespace Subscription;

use App\Enums\PaymentTypeEnum;
use App\Models\Subscription;
use App\Models\Tariff;
use Illuminate\Http\Request;

class StoreSubscription
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke(): Subscription
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
}
