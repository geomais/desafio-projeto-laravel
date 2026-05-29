<?php

declare(strict_types=1);

namespace App\Http\DTO;

final readonly class ProjectListItemResponseData
{
    public function __construct(
        public string $id,
        public string $name,
        public string $companyId,
        public string $status,
        public string $displayStatus,
        public string $city,
        public string $protocolNumber,
        public string $createdAt,
    ) {
    }

    /**
     * @return array{
     *     id: string,
     *     name: string,
     *     companyId: string,
     *     status: string,
     *     displayStatus: string,
     *     city: string,
     *     protocolNumber: string,
     *     createdAt: string
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'companyId' => $this->companyId,
            'status' => $this->status,
            'displayStatus' => $this->displayStatus,
            'city' => $this->city,
            'protocolNumber' => $this->protocolNumber,
            'createdAt' => $this->createdAt,
        ];
    }
}
