<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TicketService;

class TicketController extends BaseController
{
    private TicketService $ticketService;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->ticketService = new TicketService($config);
    }

    public function openTicket(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $ticket = $this->ticketService->openTicket($companyId, $request);

        return ['status' => 201, 'data' => $ticket];
    }

    public function closeTicket(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $ticket = $this->ticketService->closeTicket($companyId, (int) ($request['ticket_id'] ?? 0));

        return ['status' => 200, 'data' => $ticket];
    }
}
