<?php

return [
    'not_active' => 0,
    'active' => 1,
    'stop_trading' => 0,
    'is_trading' => 1,
    'records_per_page' => 5,

    'paid' => [
        'paid' => 1,
        'unpaid' => 2,
        'not_paid_in_full' => 3
    ],

    'role' => [
        'storekeeper' => 1,
        'employee' => 2,
        'admin' => 3
    ],
    'gender' => [
        'male' => 1,
        'female' => 2,
        'other' => 3,
    ],

    'category_level' => [
        'child' => 1,
        'father' => 2
    ],

    'urlImageBase' => 'storage/images/',
    'domain' => 'http://127.0.0.1:8000',

];
