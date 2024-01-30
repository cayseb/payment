<?php

namespace App\Jobs;

use App\Enums\OrderStatusEnum;
use App\Models\Card;
use App\Models\Order;
use App\Repositories\CardRepository;
use App\Repositories\OrderRepository;
use App\Repositories\SubscriptionRepository;
use App\Services\SberPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Voronkovich\SberbankAcquiring\OrderStatus;

class CheckSberOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Order $order;
    private OrderRepository $orderRepository;
    private CardRepository $cardRepository;
    private SubscriptionRepository $subscriptionRepository;
    private SberPayment $payment;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->payment = new SberPayment();
        $this->orderRepository = new OrderRepository();
        $this->subscriptionRepository = new SubscriptionRepository();
        $this->cardRepository = new CardRepository();
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = $this->payment->getOrderStatus($this->order);

        if ($response['orderStatus'] === OrderStatus::DEPOSITED) {
            $orderData['status'] = OrderStatusEnum::SUCCESS->value;
            if ($response['bindingInfo'] && $response['bindingInfo']['bindingId']) {
                //TODO проверить метод doesntExist
                if (Card::where('binding_id', $response['bindingInfo']['bindingId'])->doesntExist()) {
                    var_dump('lol');
                    $card = $this->cardRepository->store(
                        $response['bindingInfo']['bindingId'],
                        $response['cardAuthInfo']['pan'],
                        $response['cardAuthInfo']['cardholderName'],
                    );

                    $orderData['card_id'] = $card->id;
                    $subscriptionData['card_id'] = $card->id;
                    $this->subscriptionRepository->update($this->order->subscription, $subscriptionData);
                }
            }
        }
        if ($response['orderStatus'] === OrderStatus::DECLINED) {
            $orderData['status'] = OrderStatusEnum::FAILED->value;
        }

        $orderData['status_response'] = $response;

        $this->orderRepository->update($this->order, $orderData);
    }
}
