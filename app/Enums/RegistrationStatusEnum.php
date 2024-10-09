<?php

namespace App\Enums;

enum RegistrationStatusEnum : string
{
    case SCHEDULED      = 'Scheduled';
    case NOT_SCHEDULED  = 'Not scheduled';
    case VACCINATED     = 'Vaccinated';
}
