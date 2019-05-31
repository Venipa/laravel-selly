<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Selly Email
    |--------------------------------------------------------------------------
    |
    | The email address of your selly account.
    |
     */
    'email' => env('SELLY_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Selly API Key
    |--------------------------------------------------------------------------
    |
    | The API Key for your selly account. See https://selly.gg/settings
    |
     */
    'api' => [
        'key' => env('SELLY_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Selly Webhook Secret
    |--------------------------------------------------------------------------
    |
    | The webhook secret for verifying the webhook integrity.
    | See https://selly.gg/settings
    |
     */
    'webhook' => [
        'secret' => env('SELLY_WEBHOOK_SECRET'),
        'header' => env('SELLY_WEBHOOK_HEADER', 'X-Selly-Signature'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Selly API Endpoint
    |--------------------------------------------------------------------------
    |
    | The API Endpoint for the selly API.
    |
     */
    'endpoint' => env('SELLY_ENDPOINT', 'https://selly.gg/api/v2'),

];
