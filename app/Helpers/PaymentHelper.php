<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\PaymentTypeEnum;
use App\Services\AlfaPaymentFactory;
use App\Services\PaymentFactoryInterface;
use App\Services\SberPaymentFactory;
use App\Services\TinkoffPaymentFactory;

class PaymentHelper
{
    public static function getPaymentFactory(PaymentTypeEnum $paymentType): PaymentFactoryInterface
    {
        return match ($paymentType) {
            PaymentTypeEnum::Sber => new SberPaymentFactory(),
            PaymentTypeEnum::Alfa => new AlfaPaymentFactory(),

//            case PaymentTypeEnum::Tinkoff->value:
//                return new TinkoffPaymentFactory();
//
            default => new AlfaPaymentFactory(),

        };
    }
}
