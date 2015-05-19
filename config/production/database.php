<?php

return [
    'connections' => [
        'mysql' => [
            'host'      => env('DB_HOST', '127.0.0.1'),
            'database'  => env('DB_DATABASE', ''),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ],
    ],
];
