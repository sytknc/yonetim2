<?php

declare(strict_types=1);

namespace App\Services;

class UserService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function inviteUser(int $companyId, array $payload): array
    {
        $roles = ['super_admin', 'company_admin', 'accountant', 'field_agent', 'building_manager', 'resident'];
        $role = $payload['role'] ?? 'resident';

        if (!in_array($role, $roles, true)) {
            throw new \InvalidArgumentException('Role is not allowed');
        }

        return [
            'id' => random_int(1000, 9999),
            'company_id' => $companyId,
            'email' => $payload['email'] ?? '',
            'role' => $role,
            'status' => 'invited',
        ];
    }
}
