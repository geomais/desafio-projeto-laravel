<?php

declare(strict_types=1);

use App\Http\Controllers\HealthController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\FakeAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/health', HealthController::class);

Route::middleware(FakeAuthMiddleware::class)->group(function (): void {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::get('/projects/{id}/documents', [ProjectController::class, 'documents']);
});
