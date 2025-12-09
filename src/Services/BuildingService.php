<?php

declare(strict_types=1);

namespace App\Services;

class BuildingService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function createBuilding(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(10000, 99999),
            'company_id' => $companyId,
            'name' => $payload['name'] ?? 'Yeni Bina',
            'unit_count' => $payload['unit_count'] ?? 0,
            'address' => $payload['address'] ?? null,
        ];
    }
}
