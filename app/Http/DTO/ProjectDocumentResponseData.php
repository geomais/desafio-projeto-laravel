<?php

declare(strict_types=1);

namespace App\Http\DTO;

final readonly class ProjectDocumentResponseData
{
    public function __construct(
        public string $id,
        public string $name,
        public bool $required,
        public bool $uploaded,
        public ?string $uploadedAt,
    ) {
    }

    /** @return array{id: string, name: string, required: bool, uploaded: bool, uploadedAt: string|null} */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'required' => $this->required,
            'uploaded' => $this->uploaded,
            'uploadedAt' => $this->uploadedAt,
        ];
    }
}
