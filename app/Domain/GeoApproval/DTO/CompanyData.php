<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\DTO;

final readonly class CompanyData
{
    public function __construct(
        public string $id,
        public string $name,
    ) {
    }
}
