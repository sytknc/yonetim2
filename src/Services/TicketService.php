<?php

declare(strict_types=1);

namespace App\Services;

class TicketService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function openTicket(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(1000, 9999),
            'company_id' => $companyId,
            'unit_id' => $payload['unit_id'] ?? null,
            'title' => $payload['title'] ?? 'Arıza',
            'description' => $payload['description'] ?? '',
            'status' => 'open',
            'priority' => $payload['priority'] ?? 'medium',
        ];
    }

    public function closeTicket(int $companyId, int $ticketId): array
    {
        return [
            'id' => $ticketId,
            'company_id' => $companyId,
            'status' => 'closed',
            'closed_at' => date('c'),
        ];
    }
}
