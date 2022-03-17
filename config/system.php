<?php

return [


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
            ],
            'defendant' => [
                'showAddPartyButton' => true,
                'text' => 'defendant',
            ],
            'implicat-litigant' => [
                'showAddPartyButton' => true,
                'text' => 'implicat litigant',
            ],
            /* 'expert' => [
                'showAddPartyButton' => false,
                'text' => 'expert',
            ], */
            'assistant' => [
                'showAddPartyButton' => false,
                'text' => 'assistant',
            ],
            'committee' => [
                'showAddPartyButton' => false,
                'text' => 'committee',
            ],
            'marketer' => [
                'showAddPartyButton' => false,
                'text' => 'marketing',
            ],
            'third-party' => [
                'showAddPartyButton' => false,
                'text' => 'third-party',
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
                'color' => 'danger',
                'text' => 'current',
            ],
            'reported' => [
                'color' => 'warning',
                'text' => 'reported',
            ],
            'submitted' => [
                'color' => 'primary',
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
