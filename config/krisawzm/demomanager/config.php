<?php

return [
    'base_theme' => 'oc-demo',

    'admin' => [
        'login'    => env('ADMIN_LOGIN', 'admin'),
        'password' => env('ADMIN_PASSWORD', 'admin'),
    ],

    'permissions' => [
        'rainlab.pages.manage_pages',
        'rainlab.pages.access_snippets',
    ],

    'provisioners' => [
        '\Krisawzm\Embed\DemoProvisioners\SettingsProvisioner',
    ],

    'reset_interval' => 'daily',
];
