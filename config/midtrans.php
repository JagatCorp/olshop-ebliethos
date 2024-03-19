<?php

return [
    'serverKey' => base64_encode(env('MIDTRANS_SERVER_KEY', null)), // Konversi ke base64
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', true),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
];
