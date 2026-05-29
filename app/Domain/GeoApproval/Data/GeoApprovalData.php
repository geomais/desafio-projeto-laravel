<?php

declare(strict_types=1);

namespace App\Domain\GeoApproval\Data;

use App\Domain\GeoApproval\DTO\CompanyData;
use App\Domain\GeoApproval\DTO\ProjectData;
use App\Domain\GeoApproval\DTO\ProjectDocumentData;
use App\Domain\GeoApproval\DTO\UserData;
use App\Domain\GeoApproval\Enums\ProjectStatus;
use App\Domain\GeoApproval\Enums\UserRole;

final class GeoApprovalData
{
    /** @return array<int, CompanyData> */
    public static function companies(): array
    {
        return [
            new CompanyData('company-north', 'Construtora Norte'),
            new CompanyData('company-south', 'Urbaniza Sul'),
        ];
    }

    /** @return array<int, UserData> */
    public static function users(): array
    {
        return [
            new UserData('user-north', 'Ana Martins', 'ana.martins@construtoranorte.example', 'company-north', UserRole::USER),
            new UserData('user-south', 'Bruno Vieira', 'bruno.vieira@urbanizasul.example', 'company-south', UserRole::USER),
            new UserData('user-admin', 'Carla Menezes', 'carla.menezes@geoapproval.example', null, UserRole::ADMIN_GLOBAL),
        ];
    }

    /** @return array<int, ProjectData> */
    public static function projects(): array
    {
        return [
            new ProjectData(
                id: 'project-palmeiras',
                name: 'Residencial Jardim das Palmeiras',
                status: ProjectStatus::IN_REVIEW,
                companyId: 'company-north',
                address: 'Rua das Palmeiras, 1200',
                city: 'Joinville',
                protocolNumber: 'GEO-2026-0001',
                createdAt: '2026-01-15T10:30:00-03:00',
            ),
            new ProjectData(
                id: 'project-bela-vista',
                name: 'Loteamento Bela Vista',
                status: ProjectStatus::APPROVED,
                companyId: 'company-north',
                address: 'Estrada Bela Vista, km 4',
                city: 'Blumenau',
                protocolNumber: 'GEO-2026-0002',
                createdAt: '2026-02-08T14:20:00-03:00',
            ),
            new ProjectData(
                id: 'project-horizonte-sul',
                name: 'Edifício Horizonte Sul',
                status: ProjectStatus::IN_REVIEW,
                companyId: 'company-south',
                address: 'Avenida Atlântica, 455',
                city: 'Florianópolis',
                protocolNumber: 'GEO-2026-0003',
                createdAt: '2026-03-11T09:45:00-03:00',
            ),
            new ProjectData(
                id: 'project-parque-linear',
                name: 'Condomínio Parque Linear',
                status: ProjectStatus::REJECTED,
                companyId: 'company-south',
                address: 'Rua Parque Linear, 88',
                city: 'São José',
                protocolNumber: 'GEO-2026-0004',
                createdAt: '2026-04-02T16:05:00-03:00',
            ),
        ];
    }

    /** @return array<int, ProjectDocumentData> */
    public static function projectDocuments(): array
    {
        return [
            new ProjectDocumentData('document-palmeiras-planta', 'project-palmeiras', 'Planta arquitetônica', true, true, '2026-01-16T11:10:00-03:00'),
            new ProjectDocumentData('document-palmeiras-memorial', 'project-palmeiras', 'Memorial descritivo', true, false, null),
            new ProjectDocumentData('document-palmeiras-art', 'project-palmeiras', 'ART/RRT', true, true, '2026-01-17T08:40:00-03:00'),
            new ProjectDocumentData('document-bela-vista-planta', 'project-bela-vista', 'Planta urbanística', true, true, '2026-02-09T10:00:00-03:00'),
            new ProjectDocumentData('document-bela-vista-memorial', 'project-bela-vista', 'Memorial descritivo', true, true, '2026-02-09T10:15:00-03:00'),
            new ProjectDocumentData('document-horizonte-planta', 'project-horizonte-sul', 'Planta arquitetônica', true, true, '2026-03-12T13:25:00-03:00'),
            new ProjectDocumentData('document-horizonte-memorial', 'project-horizonte-sul', 'Memorial descritivo', true, true, '2026-03-12T13:40:00-03:00'),
            new ProjectDocumentData('document-horizonte-art', 'project-horizonte-sul', 'ART/RRT', true, true, '2026-03-13T09:05:00-03:00'),
            new ProjectDocumentData('document-parque-planta', 'project-parque-linear', 'Planta arquitetônica', true, true, '2026-04-03T15:30:00-03:00'),
            new ProjectDocumentData('document-parque-memorial', 'project-parque-linear', 'Memorial descritivo', true, false, null),
        ];
    }
}
