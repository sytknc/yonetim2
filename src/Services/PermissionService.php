<?php

declare(strict_types=1);

namespace App\Services;

class PermissionService
{
    public function assignGroup(int $companyId, array $payload): array
    {
        $group = $payload['group'] ?? 'custom';
        $permissions = $payload['permissions'] ?? [];

        return [
            'company_id' => $companyId,
            'group' => $group,
            'permissions' => $permissions,
        ];
    }
}
