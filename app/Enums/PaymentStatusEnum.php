<?php
declare(strict_types=1);

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case INIT = 'init';
    case CREATED = 'created';
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
