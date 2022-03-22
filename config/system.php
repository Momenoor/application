<?php

return [


    'lang' => [
        'ar' => [
            'dir' => 'rtl',
            'direction' => 'rtl',
            'style' => 'direction:rtl;',
            'css' => '.rtl',
        ],
        'en' => [
            'dir' => 'ltr',
            'direction' => 'ltr',
            'style' => 'direction:ltr;',
            'css' => '',
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Main Settings
    |--------------------------------------------------------------------------
    |
    | This option controls the xxxxxx.
    |
    */

    'vat' => [
        'rate' => 5
    ],

    /*
    |--------------------------------------------------------------------------
    | Parties Types
    |--------------------------------------------------------------------------
    |
    | This option controls the xxxxxx.
    |
    */

    'parties' => [
        'type' => [
            'plaintiff' => [
                'showAddPartyButton' => true,
                'text' => 'plaintiff',
                'color' => 'primary',
            ],
            'defendant' => [
                'showAddPartyButton' => true,
                'text' => 'defendant',
                'color' => 'danger',
            ],
            'implicat-litigant' => [
                'showAddPartyButton' => true,
                'text' => 'implicat litigant',
                'color' => 'warning',
            ],
            /* 'expert' => [
                'showAddPartyButton' => false,
                'text' => 'expert',
            ], */
            'assistant' => [
                'showAddPartyButton' => false,
                'text' => 'assistant',
                'color' => 'info',
            ],
            'committee' => [
                'showAddPartyButton' => false,
                'text' => 'committee',
                'color', 'info'
            ],
            'marketer' => [
                'showAddPartyButton' => false,
                'text' => 'marketing',
                'color' => 'dark',
            ],
            'external_marketer' => [
                'showAddPartyButton' => false,
                'text' => 'third-party',
                'color' => 'dark',
            ],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Parties Types
    |--------------------------------------------------------------------------
    |
    | This option controls the xxxxxx.
    |
    */

    'matter' => [
        'status' => [
            'current' => [
                'color' => 'primary',
                'text' => 'current',
            ],
            'reported' => [
                'color' => 'warning',
                'text' => 'reported',
            ],
            'submitted' => [
                'color' => 'success',
                'text' => 'submitted',
            ],
        ],
    ],


    'claims' => [
        'main' => [
            'id' => 1,
            'name' => 'Main',
            'color' => 'success',
            'display' => true,
        ],
        'additional' => [
            'id' => 2,
            'name' => 'Additional',
            'color' => 'secondary',
            'display' => true,
        ],
        'penality' => [
            'id' => 3,
            'name' => 'Penality',
            'color' => 'danger',
            'display' => true,
        ],
        'recurring' => [
            'id' => 4,
            'name' => 'Recurring',
            'color' => 'warning',
            'display' => false,
            'values' => [
                'no' => [
                    'name' => 'No',
                    'color' => 'danger'
                ],
                'monthly' => [
                    'name' => 'Monthly',
                    'color' => 'success'
                ],
                'quartely' => [
                    'name' => 'Quartely',
                    'color' => 'primary'
                ],
                'half-yearly' => [
                    'name' => 'Half-yearly',
                    'color' => 'warning'
                ],
                'yearly' => [
                    'name' => 'Yearly',
                    'color' => 'info'
                ],
            ]
        ],
        'vat' => [
            'id' => 5,
            'name' => 'VAT',
            'color' => 'dark',
            'display' => false,
        ],
        'office_share' => [
            'id' => 6,
            'name' => 'Office Share',
            'color' => 'warning',
            'display' => true,
        ],
        'commission' => [
            'id' => 6,
            'name' => 'Commission',
            'color' => 'primary',
            'display' => false,
        ],
    ],

];
