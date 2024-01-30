<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\Uuid;

class CheckSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Subscription $subscription;

    /**
     * Create a new job instance.
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //TODO роверить условие
        if ($this->subscription->registration_at < Carbon::now()->subDays(30)) {
            $order = CreateOrderForAutoPay::create($this->subscription);
            $orderId = Uuid::fromString($order->id)->getHex()->toString();
            $params['clientId'] = $order->user_id;
            $params['features'] = 'AUTO_PAYMENT';
            $returnUrl = '';

            $result = $client->register($orderId, $order->amount, $returnUrl, $params);

            $order->external_id = $result['orderId'];
            $order->status = Order::STATUS_CREATED;
            $order->save();

            $client->paymentOrderBinding($order->external_id,$this->subscription->binding_id);
        }
    }
}
