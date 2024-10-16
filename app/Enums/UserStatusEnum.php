<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case REGISTERED = 'Registered';
    case NOT_SCHEDULED  = 'Not scheduled';
    case SCHEDULED      = 'Scheduled';
    case VACCINATED     = 'Vaccinated';
}
