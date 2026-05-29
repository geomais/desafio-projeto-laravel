<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\Enums;

enum UserRole: string
{
    case USER = 'USER';
    case ADMIN_GLOBAL = 'ADMIN_GLOBAL';
}
