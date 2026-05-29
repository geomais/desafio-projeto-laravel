<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\Enums;

enum DisplayStatus: string
{
    case DRAFT = 'DRAFT';
    case IN_REVIEW = 'IN_REVIEW';
    case PENDING_DOCUMENTS = 'PENDING_DOCUMENTS';
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
}
