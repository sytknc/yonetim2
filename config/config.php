<?php

declare(strict_types=1);

return [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=yonetim;charset=utf8mb4',
        'user' => 'yonetim_app',
        'password' => 'change_me',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
    'sms' => [
        'provider' => 'mock',
        'api_key' => 'set_me',
        'sender' => 'YourBrand',
    ],
    'tenancy' => [
        'enforce_company_scope' => true,
        'default_locale' => 'tr_TR',
    ],
];
