<?php

declare(strict_types=1);
namespace App\Actions\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Tariff;

class StorePaymentAction
{
    public function store(Order $order, string $paymentType, string $period): Payment
    {
        //TODO проверить тип данных периода
        $payment = new Payment();
        $payment->amount = Tariff::where('period',$period)->first()->amount;
        $payment->payment_type = $paymentType;
        $payment->order_id = $order->id;
        $payment->save();
        return $payment;
    }
}
