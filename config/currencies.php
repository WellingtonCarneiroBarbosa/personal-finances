<?php

$currencies = [
    'en-US' => [
        'code'                => 'USD',
        'symbol'              => '$',
        'name'                => 'US Dollar',
        'cents_separator'     => '.',
        'thousands_separator' => ',',
    ],

    'pt-BR' => [
        'code'                => 'BRL',
        'symbol'              => 'R$',
        'name'                => 'Brazilian Real',
        'cents_separator'     => ',',
        'thousands_separator' => '.',
    ],
];

$currencies['en'] = $currencies['en-US'];

return $currencies;
