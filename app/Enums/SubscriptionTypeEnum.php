<?php
declare(strict_types=1);

namespace App\Enums;

enum SubscriptionTypeEnum: string
{
    case AUTO_PAYMENT = 'auto_payment';
    case ONCE = 'once';
}
