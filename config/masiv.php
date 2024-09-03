<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | If you're using API credentials, change these settings. Get your
    | credentials from https://dashboard.masiv.com | 'Settings'.
    |
    */

    'api_key'    => function_exists('env') ? env('MASIV_KEY', '') : '',
    'api_secret' => function_exists('env') ? env('MASIV_SECRET', '') : '',

   /*
    |--------------------------------------------------------------------------
    | Application Identifiers
    |--------------------------------------------------------------------------
    |
    | Add an application name and version here to identify your application when
    | making API calls
    |
    */

    'app' => ['name' => function_exists('env') ? env('MASIV_APP_NAME', 'MasivLaravel') : 'MasivLaravel',
        'version' => function_exists('env') ? env('MASIV_APP_VERSION', '1.1.2') : '1.1.2'],

    /*
    |--------------------------------------------------------------------------
    | Client Override
    |--------------------------------------------------------------------------
    |
    | In the event you need to use this with masiv/client-core, this can be set
    | to provide a custom HTTP client.
    |
    */

    'http_client' => function_exists('env') ? env('MASIV_HTTP_CLIENT', '') : '',
];
