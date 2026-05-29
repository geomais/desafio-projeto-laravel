<?php

declare(strict_types=1);

namespace App\Mappers;

use App\Domain\GeoApproval\DTO\ProjectData;
use App\Domain\GeoApproval\DTO\ProjectDocumentData;
use App\Domain\GeoApproval\Enums\DisplayStatus;
use App\Http\DTO\ProjectDetailResponseData;
use App\Http\DTO\ProjectDocumentResponseData;
use App\Http\DTO\ProjectListItemResponseData;

final class ProjectMapper
{
    public function toProjectListItemResponse(ProjectData $project, DisplayStatus $displayStatus): ProjectListItemResponseData
    {
        return new ProjectListItemResponseData(
            id: $project->id,
            name: $project->name,
            companyId: $project->companyId,
            status: $project->status->value,
            displayStatus: $displayStatus->value,
            city: $project->city,
            protocolNumber: $project->protocolNumber,
            createdAt: $project->createdAt,
        );
    }

    /**
     * @param array<int, ProjectDocumentData> $documents
     */
    public function toProjectDetailResponse(ProjectData $project, array $documents): ProjectDetailResponseData
    {
        return new ProjectDetailResponseData(
            id: $project->id,
            name: $project->name,
            companyId: $project->companyId,
            status: $project->status->value,
            address: $project->address,
            city: $project->city,
            protocolNumber: $project->protocolNumber,
            createdAt: $project->createdAt,
            documents: array_map(
                fn (ProjectDocumentData $document): ProjectDocumentResponseData => $this->toProjectDocumentResponse($document),
                $documents,
            ),
        );
    }

    public function toProjectDocumentResponse(ProjectDocumentData $document): ProjectDocumentResponseData
    {
        return new ProjectDocumentResponseData(
            id: $document->id,
            name: $document->name,
            required: $document->required,
            uploaded: $document->uploaded,
            uploadedAt: $document->uploadedAt,
        );
    }
}
