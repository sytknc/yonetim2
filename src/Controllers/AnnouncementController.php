<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AnnouncementService;

class AnnouncementController extends BaseController
{
    private AnnouncementService $announcementService;

    public function __construct(array $config)
    {
        parent::__construct($config);
        $this->announcementService = new AnnouncementService($config);
    }

    public function postAnnouncement(array $request): array
    {
        $companyId = $this->requireCompanyScope($request);
        $announcement = $this->announcementService->postAnnouncement($companyId, $request);

        return ['status' => 201, 'data' => $announcement];
    }
}
