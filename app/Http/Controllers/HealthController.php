<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\DTO\HealthResponseData;
use Illuminate\Http\JsonResponse;

final class HealthController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $response = new HealthResponseData('ok', 'GeoApproval Laravel API');

        return response()->json($response->toArray());
    }
}
