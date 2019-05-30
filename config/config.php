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
    'apiKey' => env('SELLY_API_KEY'),

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
