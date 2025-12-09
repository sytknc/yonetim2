<?php

declare(strict_types=1);

namespace App\Services;

class PackageService
{
    private array $packages = [
        'starter' => ['buildings' => 10, 'units' => 200, 'sms' => 500],
    ];

    public function syncPackages(array $packages): array
    {
        foreach ($packages as $name => $settings) {
            $this->packages[$name] = $settings;
        }

        return $this->packages;
    }
}
