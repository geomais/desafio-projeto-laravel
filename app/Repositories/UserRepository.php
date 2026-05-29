<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\GeoApproval\Data\GeoApprovalData;
use App\Domain\GeoApproval\DTO\UserData;

final class UserRepository
{
    public function findById(string $id): ?UserData
    {
        foreach (GeoApprovalData::users() as $user) {
            if ($user->id === $id) {
                return $user;
            }
        }

        return null;
    }
}
