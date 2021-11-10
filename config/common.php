<?php

return [
    'not_active' => 0,
    'active' => 1,
    'records_per_page' => 5,

    'product_status' => [
        'available' => 1,
        'unavailable' => 2,
        'suspended' => 3
    ],
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

    'money_transaction_type' => [
        'import' => 1,
        'sale' => 2,
    ],

    'order_type' => [
        'sale' => 1,
        'purchase' => 2
    ],

    'urlImageBase' => 'storage/images/',
    'domain' => 'http://127.0.0.1:8000',

];
