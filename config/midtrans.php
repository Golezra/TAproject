<?php
return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-WTimzyI6er5y2PPpNQ5CJxtv'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-q2H7oFHwUzZZfZAw'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
];