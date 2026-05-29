<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\GeoApproval\DTO\AuthenticatedUserData;
use App\Http\DTO\ApiErrorResponseData;
use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class FakeAuthMiddleware
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->headers->get('x-user-id');

        if ($userId === null || trim($userId) === '') {
            $error = new ApiErrorResponseData('Missing or invalid x-user-id header', 401);

            return response()->json($error->toArray(), 401);
        }

        $user = $this->userRepository->findById($userId);

        if ($user === null) {
            $error = new ApiErrorResponseData('Invalid x-user-id header', 401);

            return response()->json($error->toArray(), 401);
        }

        $request->attributes->set('authenticatedUser', AuthenticatedUserData::fromUserData($user));

        return $next($request);
    }
}
