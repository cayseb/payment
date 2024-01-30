<?php
declare(strict_types=1);

namespace App\Enums;


enum PaymentTypeEnum: string
{
    case Sber = 'sber';
    case Alfa = 'alfa';
    case Tinkoff = 'tinkoff';
    case Umany = 'umany';
}
