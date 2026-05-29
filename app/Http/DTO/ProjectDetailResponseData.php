<?php

declare(strict_types=1);

namespace App\Http\DTO;

final readonly class ProjectDetailResponseData
{
    /**
     * @param array<int, ProjectDocumentResponseData> $documents
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $companyId,
        public string $status,
        public string $address,
        public string $city,
        public string $protocolNumber,
        public string $createdAt,
        public array $documents,
    ) {
    }

    /**
     * @return array{
     *     id: string,
     *     name: string,
     *     companyId: string,
     *     status: string,
     *     address: string,
     *     city: string,
     *     protocolNumber: string,
     *     createdAt: string,
     *     documents: array<int, array{id: string, name: string, required: bool, uploaded: bool, uploadedAt: string|null}>
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'companyId' => $this->companyId,
            'status' => $this->status,
            'address' => $this->address,
            'city' => $this->city,
            'protocolNumber' => $this->protocolNumber,
            'createdAt' => $this->createdAt,
            'documents' => array_map(
                static fn (ProjectDocumentResponseData $document): array => $document->toArray(),
                $this->documents,
            ),
        ];
    }
}
