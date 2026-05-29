<?php

declare(strict_types=1);

namespace App\Http\DTO;

final readonly class HealthResponseData
{
    public function __construct(
        public string $status,
        public string $service,
    ) {
    }

    /** @return array{status: string, service: string} */
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'service' => $this->service,
        ];
    }
}
