<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case REGISTERED    = 'Registered';
    case NOT_SCHEDULED = 'Not scheduled';
    case SCHEDULED     = 'Scheduled';
    case VACCINATED    = 'Vaccinated';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
