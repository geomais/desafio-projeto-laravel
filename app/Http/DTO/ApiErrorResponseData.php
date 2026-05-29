<?php

declare(strict_types=1);

namespace App\Http\DTO;

final readonly class ApiErrorResponseData
{
    public function __construct(
        public string $message,
        public int $statusCode,
    ) {
    }

    /** @return array{message: string, statusCode: int} */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'statusCode' => $this->statusCode,
        ];
    }
}
