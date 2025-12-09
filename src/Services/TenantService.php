<?php

declare(strict_types=1);

namespace App\Services;

class TenantService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function createCompany(array $payload): array
    {
        return [
            'id' => random_int(1000, 9999),
            'name' => $payload['name'],
            'email' => $payload['email'],
            'package' => $payload['package'],
            'status' => 'active',
        ];
    }
}
