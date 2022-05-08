<?php

return [
    'main' => [
        [
            'title' => 'matters',
            'link' => '#',
            'class' => '',
            'permission' => [
                'matter-view',
                'matter-only-own-view',
                'matter-create',
            ],
            'submenu' => [
                [
                    'title' => 'matters_list',
                    'link' => 'matter.index',
                    'class' => '',
                    'permission' => [
                        'matter-view',
                        'matter-only-own-view'
                    ],
                ],
                [
                    'title' => 'create_matter',
                    'link' => 'matter.create',
                    'class' => '',
                    'permission' => [
                        'matter-create',
                    ],
                ],
            ]
        ],
        [
            'title' => 'users',
            'permission' => [
                'user-view',
                'user-create',
                'permission-view',
                'role-view',
            ],
            'submenu' => [
                [
                    'title' => 'users_list',
                    'link' => 'user.index',
                    'permission' => [
                        'user-view',
                    ],
                ],
                [
                    'title' => 'create_user',
                    'link' => 'user.create',
                    'permission' => [
                        'user-create',
                    ],
                ],
                [
                    'title' => 'user_permissions',
                    'link' => 'permission.index',
                    'permission' => [
                        'permission-view',
                    ],
                ],
                [
                    'title' => 'user_roles',
                    'link' => 'role.index',
                    'permission' => [
                        'role-view',
                    ],
                ],
            ]
        ]
    ]
];
