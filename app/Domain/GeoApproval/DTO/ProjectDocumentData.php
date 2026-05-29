<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\DTO;

final readonly class ProjectDocumentData
{
    public function __construct(
        public string $id,
        public string $projectId,
        public string $name,
        public bool $required,
        public bool $uploaded,
        public ?string $uploadedAt,
    ) {
    }
}
