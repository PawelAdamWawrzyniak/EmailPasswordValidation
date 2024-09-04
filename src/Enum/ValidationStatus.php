<?php

declare(strict_types=1);

namespace App\Enum;

enum ValidationStatus
{
    case VALID;
    case NOT_VALID;
    case NOT_SET;
}
