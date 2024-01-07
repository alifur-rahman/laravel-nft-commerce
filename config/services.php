<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [ 
        'client_id' => '84981670002-5b7lka0sh19e3avhnor56tp6j3nb95kr.apps.googleusercontent.com', 
        'client_secret' => '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', 
        // 'redirect' => 'http://localhost:8000/auth/google/callback',
        'redirect' => 'http://enviva.io/auth/google/callback', 
    ],
    'facebook' => [
        'client_id' => '651685699597630', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '7e8d4b363622b3668cfc80cfdb1999c9', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'http://enviva.io/auth/facebook/callback'
    ], 
    // 'facebook' => [
    //     'client_id' => '1056182818404479', //USE FROM FACEBOOK DEVELOPER ACCOUNT
    //     'client_secret' => '080bc83c00cabd6333f772eb679e0a0f', //USE FROM FACEBOOK DEVELOPER ACCOUNT
    //     'redirect' => 'http://localhost:8000/auth/facebook/callback'
    // ], 
];
