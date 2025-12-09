<?php

declare(strict_types=1);

namespace App\Services;

class AnnouncementService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function postAnnouncement(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(1000, 9999),
            'company_id' => $companyId,
            'building_id' => $payload['building_id'] ?? null,
            'title' => $payload['title'] ?? 'Duyuru',
            'body' => $payload['body'] ?? '',
            'audience' => $payload['audience'] ?? 'residents',
            'visible_until' => $payload['visible_until'] ?? null,
        ];
    }
}
