<?php

declare(strict_types=1);

namespace App\Services;

class FinanceService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function issueInvoice(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(100000, 999999),
            'company_id' => $companyId,
            'unit_id' => $payload['unit_id'] ?? null,
            'amount' => $payload['amount'] ?? 0,
            'due_date' => $payload['due_date'] ?? date('Y-m-d'),
            'description' => $payload['description'] ?? 'Aidat',
            'status' => 'pending',
        ];
    }

    public function recordPayment(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(100000, 999999),
            'company_id' => $companyId,
            'invoice_id' => $payload['invoice_id'] ?? null,
            'method' => $payload['method'] ?? 'cash',
            'amount' => $payload['amount'] ?? 0,
            'processed_at' => date('c'),
        ];
    }

    public function registerVendor(int $companyId, array $payload): array
    {
        return [
            'id' => random_int(100000, 999999),
            'company_id' => $companyId,
            'name' => $payload['name'] ?? 'Tedarikçi',
            'type' => $payload['type'] ?? 'supplier',
            'contact' => $payload['contact'] ?? null,
        ];
    }
}
