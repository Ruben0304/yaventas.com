<?php

return [
    'name' => 'YaVentas',
    'manifest' => [
        'name' => 'YaVentas',
        'short_name' => 'YaVentas',
        'start_url' => '/inicio',
        'background_color' => 'white',
        'theme_color' => 'white',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'white',
        'icons' => [
            '72x72' => [
                'path' => 'img/logo/72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => 'img/logo/96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => 'img/logo/128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => 'img/logo/144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => 'img/logo/152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => 'img/logo/192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => 'img/logo/384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => 'img/logo/512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/img/logo/512.png',
            '750x1334' => '/img/logo/512.png',
            '828x1792' => '/img/logo/512.png',
            '1125x2436' => '/img/logo/512.png',
            '1242x2208' => '/img/logo/512.png',
            '1242x2688' => '/img/logo/512.png',
            '1536x2048' => '/img/logo/512.png',
            '1668x2224' => '/img/logo/512.png',
            '1668x2388' => '/img/logo/512.png',
            '2048x2732' => '/img/logo/512.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/img/logo/512.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
