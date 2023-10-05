<?php

declare(strict_types=1);

namespace App\Billing\Alfabank\Enum;

class OperationTypeEnum
{
    public const APPROVED = 'approved';
    public const DEPOSITED = 'deposited';
    public const REVERSED = 'reversed';
    public const REFUNDED = 'refunded';
    public const DECLINED_BY_TIMEOUT = 'declinedByTimeout';

    public array $types = [
        self::APPROVED,
        self::DEPOSITED,
        self::REVERSED,
        self::REFUNDED,
        self::DECLINED_BY_TIMEOUT,
    ];
}
