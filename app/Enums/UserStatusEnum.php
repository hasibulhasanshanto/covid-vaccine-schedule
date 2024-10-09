<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case NOT_REGISTERED = 'Not registered';
    case NOT_SCHEDULED  = 'Not scheduled';
    case SCHEDULED      = 'Scheduled';
    case VACCINATED     = 'Vaccinated';
}
