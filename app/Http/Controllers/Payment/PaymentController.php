<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payment;

use App\Actions\Subscription\UpdateOrCreateSubscriptionAction;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentTypeEnum;
use App\Enums\SubscriptionTypeEnum;
use App\Helpers\PaymentHelper;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Ramsey\Uuid\Uuid;

class PaymentController
{


    public function __construct()
    {
        $this->subscriptionAction = new UpdateOrCreateSubscriptionAction();
        $this->orderRepository = new OrderRepository();
    }

    public function index(Request $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $subscription = $this->subscriptionAction
            ->updateOrCreate(
            PaymentTypeEnum::from($request->payment_type),
            SubscriptionTypeEnum::from($request->type),
            $request->period
        );

        $order = $this->orderRepository->store($subscription->tariff->price,$subscription->id);

        $orderId = Uuid::fromString($order->id)->getHex()->toString();

        $payment = PaymentHelper::getPaymentFactory(
            PaymentTypeEnum::from($request->get('type', 'sber'))
        )->createPayment();

        $response = $payment->register($orderId, $order->amount, $order->subscription->user_id);

        $data['external_id'] = $response['orderId'];
        $data['status'] = OrderStatusEnum::CREATED->value;

        $this->orderRepository->update($order, $data);

        return redirect($response['formUrl']);

    }
}
