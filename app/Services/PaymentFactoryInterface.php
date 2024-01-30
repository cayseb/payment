<?php
declare(strict_types=1);

namespace App\Services;

interface PaymentFactoryInterface
{
    public static function createPayment():PaymentInterface;
}
