<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\GeoApproval\Data\GeoApprovalData;
use App\Domain\GeoApproval\DTO\ProjectData;
use App\Domain\GeoApproval\DTO\ProjectDocumentData;

final class ProjectRepository
{
    /** @return array<int, ProjectData> */
    public function findAll(): array
    {
        return GeoApprovalData::projects();
    }

    public function findById(string $id): ?ProjectData
    {
        foreach (GeoApprovalData::projects() as $project) {
            if ($project->id === $id) {
                return $project;
            }
        }

        return null;
    }

    /** @return array<int, ProjectData> */
    public function findByCompanyId(string $companyId): array
    {
        return array_values(array_filter(
            GeoApprovalData::projects(),
            static fn (ProjectData $project): bool => $project->companyId === $companyId,
        ));
    }

    /** @return array<int, ProjectDocumentData> */
    public function findDocumentsByProjectId(string $projectId): array
    {
        return array_values(array_filter(
            GeoApprovalData::projectDocuments(),
            static fn (ProjectDocumentData $document): bool => $document->projectId === $projectId,
        ));
    }
}
