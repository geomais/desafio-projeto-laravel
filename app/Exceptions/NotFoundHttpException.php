<?php

declare(strict_types=1);

namespace App\Exceptions;

final class NotFoundHttpException extends AppHttpException
{
    public function __construct(string $message = 'Resource not found')
    {
        parent::__construct($message, 404);
    }
}
