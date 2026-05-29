<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\GeoApproval\DTO\AuthenticatedUserData;
use App\Domain\GeoApproval\DTO\ProjectData;
use App\Domain\GeoApproval\DTO\ProjectDocumentData;
use App\Domain\GeoApproval\Enums\DisplayStatus;
use App\Domain\GeoApproval\Enums\ProjectStatus;
use App\Domain\GeoApproval\Enums\UserRole;
use App\Exceptions\NotFoundHttpException;
use App\Exceptions\UnauthorizedHttpException;
use App\Http\DTO\ProjectDetailResponseData;
use App\Http\DTO\ProjectDocumentResponseData;
use App\Http\DTO\ProjectListItemResponseData;
use App\Mappers\ProjectMapper;
use App\Repositories\ProjectRepository;

final class ProjectService
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
        private readonly ProjectMapper $projectMapper,
    ) {
    }

    /** @return array<int, ProjectListItemResponseData> */
    public function listProjects(AuthenticatedUserData $user): array
    {
        $projects = $user->role === UserRole::ADMIN_GLOBAL
            ? $this->projectRepository->findAll()
            : $this->projectRepository->findByCompanyId($user->companyId ?? '');

        return array_map(
            fn (ProjectData $project): ProjectListItemResponseData => $this->projectMapper->toProjectListItemResponse(
                $project,
                $this->calculateDisplayStatus($project),
            ),
            $projects,
        );
    }

    public function getProjectById(string $projectId, AuthenticatedUserData $user): ProjectDetailResponseData
    {
        $project = $this->projectRepository->findById($projectId);

        if ($project === null) {
            throw new NotFoundHttpException('Project not found');
        }

        $documents = $this->projectRepository->findDocumentsByProjectId($project->id);

        return $this->projectMapper->toProjectDetailResponse($project, $documents);
    }

    /** @return array<int, ProjectDocumentResponseData> */
    public function listProjectDocuments(string $projectId, AuthenticatedUserData $user): array
    {
        $project = $this->projectRepository->findById($projectId);

        if ($project === null) {
            throw new NotFoundHttpException('Project not found');
        }

        if ($user->role === UserRole::USER && $project->companyId !== $user->companyId) {
            throw new UnauthorizedHttpException('User cannot access this project');
        }

        return array_map(
            fn (ProjectDocumentData $document): ProjectDocumentResponseData => $this->projectMapper->toProjectDocumentResponse($document),
            $this->projectRepository->findDocumentsByProjectId($project->id),
        );
    }

    public function calculateDisplayStatus(ProjectData $project): DisplayStatus
    {
        if ($project->status !== ProjectStatus::IN_REVIEW) {
            return DisplayStatus::from($project->status->value);
        }

        foreach ($this->projectRepository->findDocumentsByProjectId($project->id) as $document) {
            if ($document->required && ! $document->uploaded) {
                return DisplayStatus::PENDING_DOCUMENTS;
            }
        }

        return DisplayStatus::IN_REVIEW;
    }
}
