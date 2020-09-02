<?php

return [
    '__name' => 'site-user-handshake',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/site-user-handshake.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'app/site-user-handshake' => ['install','remove'],
        'modules/site-user-handshake' => ['install','update','remove'],
        'theme/site/me/handshake' => ['install','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-user' => NULL
            ],
            [
                'lib-user-auth-handshake' => NULL
            ],
            [
                'site' => NULL
            ],
            [
                'lib-user-auth-cookie' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'SiteUserHandshake\\Controller' => [
                'type' => 'file',
                'base' => 'app/site-user-handshake/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'site' => [
            'siteMeHandshakeDeliver' => [
                'path' => [
                    'value' => '/me/handshake/deliver'
                ],
                'handler' => 'SiteUserHandshake\\Controller\\Handshake::deliver',
                'method' => 'GET|POST'
            ],
            'siteMeHandshakeReceive' => [
                'path' => [
                    'value' => '/me/handshake/receive'
                ],
                'handler' => 'SiteUserHandshake\\Controller\\Handshake::receive',
                'method' => 'GET|POST'
            ]
        ]
    ]
];