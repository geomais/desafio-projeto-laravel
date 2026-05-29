<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\DTO;

use App\Domain\GeoApproval\Enums\UserRole;

final readonly class UserData
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $companyId,
        public UserRole $role,
    ) {
    }
}
