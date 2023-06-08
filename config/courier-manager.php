<?php

return [
    'courier' => [
        'driver' => env('COURIER_MANAGER', 'none'),
    ],
    'labels' => [
        'persist' => env('COURIER_MANAGER_LABELS_PERSIST', false),
        'path' => env('COURIER_MANAGER_LABELS_STORAGE_PATH', ''),
    ],
];
