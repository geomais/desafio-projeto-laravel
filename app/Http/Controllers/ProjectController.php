<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\GeoApproval\DTO\AuthenticatedUserData;
use App\Exceptions\UnauthorizedHttpException;
use App\Http\DTO\ProjectDocumentResponseData;
use App\Http\DTO\ProjectListItemResponseData;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectService->listProjects($this->authenticatedUser($request));

        return response()->json(array_map(
            static fn (ProjectListItemResponseData $project): array => $project->toArray(),
            $projects,
        ));
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $project = $this->projectService->getProjectById($id, $this->authenticatedUser($request));

        return response()->json($project->toArray());
    }

    public function documents(Request $request, string $id): JsonResponse
    {
        $documents = $this->projectService->listProjectDocuments($id, $this->authenticatedUser($request));

        return response()->json(array_map(
            static fn (ProjectDocumentResponseData $document): array => $document->toArray(),
            $documents,
        ));
    }

    private function authenticatedUser(Request $request): AuthenticatedUserData
    {
        $authenticatedUser = $request->attributes->get('authenticatedUser');

        if (! $authenticatedUser instanceof AuthenticatedUserData) {
            throw new UnauthorizedHttpException('Authenticated user not available');
        }

        return $authenticatedUser;
    }
}
