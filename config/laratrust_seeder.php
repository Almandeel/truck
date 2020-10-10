<?php

return [


    'role_structure' => [

        'superadmin' => [
            'users'                 => 'c,r,u,d',
            'units'                 => 'c,r,u,d',
            'zones'                 => 'c,r,u,d',
            'vehicles'              => 'c,r,u,d',
            'orders'                => 'c,r,u,d,p',
            'companies'             => 'c,r,u,d',
            'accountings'           => 'c,r,u,d,p',
            'pricings'              => 'c,r,u,d',
            'enteries'              => 'c,r,u,d,p',
            'payments'              => 'c,r,u,d,p',
            'dashboard'             => 'r',
        ],

        'company' => [
            'orders'                => 'r',
            'dashboard'             => 'r',
        ],

        'customer' => [
            'orders'                => 'c,r,d',
            'dashboard'             => 'r',
        ],

        'services' => [
            'order'                => 'c,r,u',
        ],

    ],
    'permission_structure' => [
        'super' => [
            'users'                 => 'c,r,u,d',
            'units'                 => 'c,r,u,d',
            'zones'                 => 'c,r,u,d',
            'vehicles'              => 'c,r,u,d',
            'orders'                => 'c,r,u,d',
            'companies'             => 'c,r,u,d',
            'accountings'           => 'c,r,u,d,p',
            'pricings'              => 'c,r,u,d',
            'enteries'              => 'c,r,u,d,p',
            'payments'              => 'c,r,u,d,p',
            'dashboard'             => 'r',
        ],
    ],


    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'p' => 'print',
    ]
];
