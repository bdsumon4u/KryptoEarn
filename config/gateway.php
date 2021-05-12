<?php

return [
    'setup' => [
        'perfect-money' => [
            'wallet_id' => '',
            'passphrase' => '',
        ],
        'blockchain' => [
            'secret' => '',
            'xpub_key' => '',
            'api_key' => '',
        ],
        'payeer' => [
            'merchant_id' => '',
            'secret' => '',
        ],
    ],

    'deposit' => [
        'perfect_money' => [
            'min_amount' => 3,
            'max_amount' => 20000,
            'fixed_charge' => 0,
            'percent_charge' => 0,
        ],

        'bitcoin' => [
            'min_amount' => 1,
            'max_amount' => 20000,
            'fixed_charge' => 0,
            'percent_charge' => 0,
        ],

        'payeer' => [
            'min_amount' => 1,
            'max_amount' => 20000,
            'fixed_charge' => 0.50,
            'percent_charge' => 1,
        ],
    ],

    'withdraw' => [
        'perfect_money' => [
            'min_amount' => 1,
            'max_amount' => 20000,
            'fixed_charge' => 0,
            'percent_charge' => 0,
        ],

        'bitcoin' => [
            'min_amount' => 1,
            'max_amount' => 20000,
            'fixed_charge' => 0,
            'percent_charge' => 0,
        ],

        'payeer' => [
            'min_amount' => 1,
            'max_amount' => 20000,
            'fixed_charge' => 0.50,
            'percent_charge' => 1,
        ],
    ],
];
