<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'firebase' => [
        'api_key' => env('AIzaSyATEWess4TzascKpn85ApXY_Z68j-FCFlY'),
        'auth_domain' => env('bookstore-f7ae3.firebaseapp.com'),
        'database_url' => env('https://bookstore-f7ae3.firebaseio.com'),
        'project_id' => env('bookstore-f7ae3'),
        'secret' => env('FAAH2PF2iA0iFJmjNKTQ9K26yaoWN3vRykYmmrU2'),
        'storage_bucket' => env('bookstore-f7ae3.appspot.com'),
        'messaging_sender_id' => env('421717153339')
    ]
];
