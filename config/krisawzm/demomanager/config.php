<?php

return [
    'base_theme' => 'oc-demo',

    'admin' => [
        'login'    => 'kristoffer',
        'password' => '12345678',
    ],

    'permissions' => [
        'krisawzm.embed.settings',
        'rainlab.pages.manage_pages',
        'rainlab.pages.access_snippets',
    ],

    'provisioners' => [
        '\Krisawzm\Embed\DemoProvisioners\SettingsProvisioner',
    ],
];
