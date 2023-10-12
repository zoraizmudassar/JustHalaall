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

    'facebook' => [
        'client_id'     => '3118535295122430',
        'client_secret' => 'a4086786e2fde51b9799bd92d2edacd9',
        'redirect'      => 'https://127.0.0.1:8000/oauth/facebook/callback',
    ],

    'google' => [
        'client_id'     => '34948595426-5mu9aigvrtccdjr41qjq72ftd0clk5mi.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://127.0.0.1:8000/oauth/google/callback',
    ],
    'googlemaps' => [
        'key' => env('GOOGLE_MAPS_API_KEY'),
    ]

];
