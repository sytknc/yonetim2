<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\FinanceService;

class FinanceController extends BaseController
{
    private FinanceService $financeService;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->financeService = new FinanceService($config);
    }

    public function issueInvoice(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $invoice = $this->financeService->issueInvoice($companyId, $request);

        return ['status' => 201, 'data' => $invoice];
    }

    public function recordPayment(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $payment = $this->financeService->recordPayment($companyId, $request);

        return ['status' => 201, 'data' => $payment];
    }

    public function registerVendor(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $vendor = $this->financeService->registerVendor($companyId, $request);

        return ['status' => 201, 'data' => $vendor];
    }
}
