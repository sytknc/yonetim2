<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BuildingService;
use App\Services\PermissionService;
use App\Services\UserService;

class CompanyController extends BaseController
{
    private BuildingService $buildingService;
    private UserService $userService;
    private PermissionService $permissionService;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->buildingService = new BuildingService($config);
        $this->userService = new UserService($config);
        $this->permissionService = new PermissionService();
    }

    public function registerBuilding(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $building = $this->buildingService->createBuilding($companyId, $request);

        return ['status' => 201, 'data' => $building];
    }

    public function inviteUser(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $user = $this->userService->inviteUser($companyId, $request);

        return ['status' => 201, 'data' => $user];
    }

    public function assignPermissionGroup(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $group = $this->permissionService->assignGroup($companyId, $request);

        return ['status' => 200, 'data' => $group];
    }
}
