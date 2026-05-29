<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\DTO;

use App\Domain\GeoApproval\Enums\ProjectStatus;

final readonly class ProjectData
{
    public function __construct(
        public string $id,
        public string $name,
        public ProjectStatus $status,
        public string $companyId,
        public string $address,
        public string $city,
        public string $protocolNumber,
        public string $createdAt,
    ) {
    }
}
