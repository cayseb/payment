<?php
declare(strict_types=1);

namespace App\Enums;

enum OrderStatusEnum: string
{
    case PROCESSED = 'processed';
    case NOT_PROCESSED = 'not_processed';
}
