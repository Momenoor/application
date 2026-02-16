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
        'types' => [
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
                'arrbitrator' => 'arrbitrator',
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
                'index' => 1,
            ],
            'reported' => [
                'color' => 'warning',
                'text' => 'reported',
                'index' => 2,
            ],
            'submitted' => [
                'color' => 'success',
                'text' => 'submitted',
                'index' => 3,
            ],
        ],
        'difficulty_levels' => [
            'simple' => [
                'color' => 'success',
                'text' => 'بسيطة',
            ],
            'medium' => [
                'color' => 'warning',
                'text' => 'متوسطة',
            ],
            'exceptional' => [
                'color' => 'danger',
                'text' => 'استثنائية',
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
                'condition' => +1,
                'type' => 'income',
            ],
            'additional' => [
                'id' => 2,
                'name' => 'Additional',
                'color' => 'info',
                'active' => true,
                'condition' => +1,
                'type' => 'income',
            ],
            'penalty' => [
                'id' => 3,
                'name' => 'Penalty',
                'color' => 'danger',
                'active' => true,
                'condition' => -1,
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
                    'quarterly' => [
                        'name' => 'Quarterly',
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
                'condition' => +1,
                'type' => 'income',
            ],
            'office_share' => [
                'id' => 6,
                'name' => 'Office Share',
                'color' => 'warning',
                'active' => true,
                'condition' => -1,
                'type' => 'expense',
            ],
            'office share' => [
                'id' => 6,
                'name' => 'Office Share',
                'color' => 'warning',
                'active' => true,
                'condition' => -1,
                'type' => 'expense',
            ],
            'commission' => [
                'id' => 7,
                'name' => 'Commission',
                'color' => 'primary',
                'active' => false,
                'condition' => -1,
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
        'first_instance' => [
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
    'commission' => [
        'special_type_ids' => [
            203,
            206
        ],
        'by_period' => [
            'default' => [
                [
                    'start' => 0,
                    'end' => 7,
                    'percent' => 5
                ],
                [
                    'start' => 8,
                    'end' => 12,
                    'percent' => 4
                ],
                [
                    'start' => 13,
                    'end' => 22,
                    'percent' => 3
                ],
                [
                    'percent' => 2
                ],

            ],
            'special' => [
                [
                    'start' => 0,
                    'end' => 7,
                    'percent' => 10
                ],
                [
                    'start' => 8,
                    'end' => 12,
                    'percent' => 9
                ],
                [
                    'start' => 13,
                    'end' => 22,
                    'percent' => 8
                ],
            ],
        ],
        'by_count' => [
            5 => 1,
            6 => 1.5,
            'more_than_6' => 2.5,
        ],
        'by_type' => [
            76 => [
                'with_expert' => 10,
                'without_expert' => 20,
            ],
            217 => 5,
            233 => 5,
            234 => 5,
        ],
        'start_day' => 26,
        'end_day' => 25,
    ],
];
