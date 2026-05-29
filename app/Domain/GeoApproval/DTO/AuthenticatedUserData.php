<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\DTO;

use App\Domain\GeoApproval\Enums\UserRole;

final readonly class AuthenticatedUserData
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $companyId,
        public UserRole $role,
    ) {
    }

    public static function fromUserData(UserData $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            companyId: $user->companyId,
            role: $user->role,
        );
    }
}
