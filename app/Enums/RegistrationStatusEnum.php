<?php

namespace App\Enums;

enum RegistrationStatusEnum: string
{
    case SCHEDULED     = 'Scheduled';
    case NOT_SCHEDULED = 'Not scheduled';
    case VACCINATED    = 'Vaccinated';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
