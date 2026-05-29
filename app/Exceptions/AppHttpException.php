<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class AppHttpException extends RuntimeException
{
    public function __construct(
        string $message,
        public readonly int $statusCode,
    ) {
        parent::__construct($message);
    }
}
