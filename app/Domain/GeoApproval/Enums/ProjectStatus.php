<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\Enums;

enum ProjectStatus: string
{
    case DRAFT = 'DRAFT';
    case IN_REVIEW = 'IN_REVIEW';
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
}
