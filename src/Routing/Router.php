<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controllers\AnnouncementController;
use App\Controllers\CompanyController;
use App\Controllers\FinanceController;
use App\Controllers\SuperAdminController;
use App\Controllers\TicketController;

class Router
{
    private SuperAdminController $superAdminController;
    private CompanyController $companyController;
    private FinanceController $financeController;
    private TicketController $ticketController;
    private AnnouncementController $announcementController;

    public function __construct(array $config)
    {
        $this->superAdminController = new SuperAdminController($config);
        $this->companyController = new CompanyController($config);
        $this->financeController = new FinanceController($config);
        $this->ticketController = new TicketController($config);
        $this->announcementController = new AnnouncementController($config);
    }

    public function dispatch(string $route, array $request): array
    {
        return match ($route) {
            'superadmin/companies' => $this->superAdminController->createCompany($request),
            'superadmin/packages' => $this->superAdminController->definePackages($request),
            'superadmin/sms' => $this->superAdminController->configureSms($request),
            'company/buildings' => $this->companyController->registerBuilding($request),
            'company/users' => $this->companyController->inviteUser($request),
            'company/permissions' => $this->companyController->assignPermissionGroup($request),
            'finance/invoices' => $this->financeController->issueInvoice($request),
            'finance/payments' => $this->financeController->recordPayment($request),
            'finance/vendors' => $this->financeController->registerVendor($request),
            'support/tickets' => $this->ticketController->openTicket($request),
            'support/tickets/close' => $this->ticketController->closeTicket($request),
            'communication/announcements' => $this->announcementController->postAnnouncement($request),
            default => ['status' => 404, 'message' => 'Route not found'],
        };
    }
}
