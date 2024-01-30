<?php

declare(strict_types=1);
namespace App\Services;


class TinkoffPaymentFactory implements PaymentFactoryInterface
{
    public static function createPayment(): PaymentInterface
    {
        return new TinkoffPayment();
    }
}
