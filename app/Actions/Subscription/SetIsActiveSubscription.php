<?php

declare(strict_types=1);

namespace Subscription;

use App\Models\Subscription;

class SetIsActiveSubscription
{
    private Subscription $subscription;
    private bool $isActive;

    public function __construct(Subscription $subscription, bool $isActive)
    {
        $this->subscription = $subscription;
        $this->isActive = $isActive;
    }

    public function __invoke(): void
    {
        $this->subscription->update(['is_active' => $this->isActive]);
    }
}
