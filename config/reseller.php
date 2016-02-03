<?php

return [
    'default_per_page' => 25,
    'client' => App\Models\Reseller\Client\Client::class,
    'client_table' => 'client',
    'clients' => [
        'default_per_page' => 25
    ],
    'apikey' => App\Models\Reseller\ApiKey\ApiKey::class,
    'apikey_table' => 'api_keys',
    'reseller_table' => 'users'
];