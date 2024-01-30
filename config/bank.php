<?php
declare(strict_types=1);

return [
    'sber' => [
        'login' => env('LOGIN_SBER'),
        'password' => env('PASSWORD_SBER'),
    ],
    'alfa' => [
        'login' => env('LOGIN_ALFA'),
        'password' => env('PASSWORD_ALFA'),
    ],
    'tinkoff' => [
        'terminalKey'=> env('TINKOFF_TERMINAL_KEY',''),
        'secretKey'=> env('TINKOFF_SECRET_KEY',''),
        'api_url'=> env('TINKOFF_API_URL',''),
    ],
    'successUrl' => 'asdasdas',
    'failUrl' => 'asdasdas',
];
