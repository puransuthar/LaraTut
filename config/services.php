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
        'client_id' => '947953121766-klu1nhkkrkb7h614l6tjues3a27tio5i.apps.googleusercontent.com',
        'client_secret' => 'TQ6pAMJWltOBQwmQTXyvWG8c',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ],

    'github' => [
        'client_id' => 'e4f0f597837ef896615b',
        'client_secret' => '6b0459b21fc9535b5db4a42882e87c31b82dc3ab',
        'redirect' => 'http://127.0.0.1:8000/callback/github',
    ],

    'facebook' => [
        'client_id' => '390808385567510',
        'client_secret' => 'eb0933ce735028a91cc289edbff80321',
        'redirect' => 'http://127.0.0.1:8000/callback/facebook',
    ],

];
