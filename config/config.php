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
    'email' => null,

    /*
    |--------------------------------------------------------------------------
    | Selly API Key
    |--------------------------------------------------------------------------
    |
    | The API Key for your selly account. See https://selly.gg/settings
    |
     */
    'api' => [
        'key' => null,
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
        'secret' => null,
        'header' => 'X-Selly-Signature',
    ],

    /*
    |--------------------------------------------------------------------------
    | Selly API Endpoint
    |--------------------------------------------------------------------------
    |
    | The API Endpoint for the selly API.
    |
     */
    'endpoint' => 'https://selly.gg/api/v2',

];
