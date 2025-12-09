<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class BaseController
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function requireCompanyScope(array $request): int
    {
        if (!isset($request['company_id'])) {
            throw new \InvalidArgumentException('company_id is required for tenant isolation');
        }

        return (int) $request['company_id'];
    }
}
