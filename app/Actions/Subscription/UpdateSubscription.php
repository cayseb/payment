<?php

declare(strict_types=1);

namespace Subscription;

use App\Models\Subscription;

class UpdateSubscription
{
    private Subscription $subscription;
    private array $data;

    public function __construct(Subscription $subscription, array $data)
    {
        $this->subscription = $subscription;
        $this->data = $data;
    }

    public function __invoke(): void
    {
        $this->subscription->update($this->data);
    }
}
