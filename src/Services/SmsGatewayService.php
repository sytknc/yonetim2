<?php

declare(strict_types=1);

namespace App\Services;

class SmsGatewayService
{
    private array $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function updateSettings(array $settings): array
    {
        $this->settings = array_merge($this->settings, $settings);
        return $this->settings;
    }
}
