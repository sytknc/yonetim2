<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\PackageService;
use App\Services\SmsGatewayService;
use App\Services\TenantService;

class SuperAdminController extends BaseController
{
    private TenantService $tenantService;
    private PackageService $packageService;
    private SmsGatewayService $smsGatewayService;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->tenantService = new TenantService($config);
        $this->packageService = new PackageService();
        $this->smsGatewayService = new SmsGatewayService($config['sms']);
    }

    public function createCompany(array $request): array
    {
        $payload = [
            'name' => $request['name'] ?? '',
            'email' => $request['email'] ?? '',
            'package' => $request['package'] ?? 'starter',
        ];

        $company = $this->tenantService->createCompany($payload);

        return ['status' => 201, 'data' => $company];
    }

    public function definePackages(array $request): array
    {
        $packages = $request['packages'] ?? [];
        $stored = $this->packageService->syncPackages($packages);

        return ['status' => 200, 'data' => $stored];
    }

    public function configureSms(array $request): array
    {
        $config = $this->smsGatewayService->updateSettings($request);

        return ['status' => 200, 'data' => $config];
    }
}
