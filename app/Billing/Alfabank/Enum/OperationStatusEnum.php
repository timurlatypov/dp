<?php

declare(strict_types=1);

namespace App\Billing\Alfabank\Enum;

class OperationStatusEnum
{
    public const SUCCESS = 1;
    public const ERROR = 0;

    public array $statuses = [
        self::SUCCESS,
        self::ERROR,
    ];
}
