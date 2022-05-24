<?php

use App\Models\Expert;
use App\Models\Party;

return [


    'lang' => [
        'ar' => [
            'dir' => 'rtl',
            'direction' => 'rtl',
            'style' => 'direction:rtl;',
            'css' => '.rtl',
            'text' => 'العربية - Arabic',
        ],
        'en' => [
            'dir' => 'ltr',
            'direction' => 'ltr',
            'style' => 'direction:ltr;',
            'css' => '',
            'text' => 'الأنجليزية - English',
        ]
    ],


    'events' => [
        'types'=> [
            'public_holiday',
            'annual_leave',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Main Settings
    |--------------------------------------------------------------------------
    |
    | This option controls the xxxxxx.
    |
    */

    'last_activity' => [
        'start_day' => '23',
    ],

    'vat' => [
        'rate' => 5
    ],

    'experts' =>
    [
        'office_share' => [
            'rate' => 15,
        ],
        'main' => [1],
        'fields' => [
            'accounting' => 'accounting',
            'engineering' => 'engineering',
            'banking' => 'banking',
            'technology' => 'technology',
            'realestate' => 'realestate',
        ]
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
                'model' => Party::class,
                'type' => 'party',
            ],
            'defendant' => [
                'showAddPartyButton' => true,
                'text' => 'defendant',
                'color' => 'danger',
                'model' => Party::class,
                'type' => 'party',
            ],
            'implicat-litigant' => [
                'showAddPartyButton' => true,
                'text' => 'implicat litigant',
                'color' => 'info',
                'model' => Party::class,
                'type' => 'party',
            ],
            /* 'expert' => [
                'showAddPartyButton' => false,
                'text' => 'expert',
            ],
            'assistant' => [
                'showAddPartyButton' => false,
                'text' => 'assistant',
                'color' => 'info',
                'model' => Expert::class,
                'type' => 'assistant',
            ],
            'committee' => [
                'showAddPartyButton' => false,
                'text' => 'committee',
                'color', 'info',
                'model' => Expert::class,
                'type' => 'committee',
            ],
            'marketer' => [
                'showAddPartyButton' => false,
                'text' => 'marketing',
                'color' => 'dark',
                'model' => Party::class,
                'type' => 'marketer',
            ],
            'external_marketer' => [
                'showAddPartyButton' => false,
                'text' => 'third-party',
                'color' => 'dark',
                'model' => Party::class,
                'type' => 'external_marketer',
            ], */
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
        'types' => [
            'main' => [
                'id' => 1,
                'name' => 'Main',
                'color' => 'success',
                'active' => true,
                'condition' => '+',
                'type' => 'income',
            ],
            'additional' => [
                'id' => 2,
                'name' => 'Additional',
                'color' => 'info',
                'active' => true,
                'condition' => '+',
                'type' => 'income',
            ],
            'penality' => [
                'id' => 3,
                'name' => 'Penality',
                'color' => 'danger',
                'active' => true,
                'condition' => '-',
                'type' => 'expense',
            ],
            'recurring' => [
                'id' => 4,
                'name' => 'Recurring',
                'color' => 'warning',
                'active' => false,
                'values' => [
                    'none' => [
                        'name' => 'None',
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
                'active' => false,
                'condition' => '+',
                'type' => 'income',
            ],
            'office_share' => [
                'id' => 6,
                'name' => 'Office Share',
                'color' => 'warning',
                'active' => true,
                'condition' => '-',
                'type' => 'expense',
            ],
            'commission' => [
                'id' => 6,
                'name' => 'Commission',
                'color' => 'primary',
                'active' => false,
                'condition' => '-',
                'type' => 'expense',
            ],
        ],
        'status' => [
            'unpaid' => [
                'color' => 'danger',
            ],
            'overpaid' => [
                'color' => 'info',
            ],
            'paid' => [
                'color' => 'success',
            ],
            'partial' => [
                'color' => 'warning',
            ],
        ],
    ],
    'level' => [
        'first_istance' => [
            'id' => '1',
            'name' => 'first_instance'
        ],
        'appeal' => [
            'id' => '2',
            'name' => 'appeal'
        ],
        'cassation' => [
            'id' => '3',
            'name' => 'cassation'
        ],
    ],
];
