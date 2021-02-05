<?php
//ChatBot
return [

    'botman' => [
        'hipchat_urls' => [
            'YOUR-INTEGRATION-URL-1',
            'YOUR-INTEGRATION-URL-2',
        ],
        'nexmo_key' => 'YOUR-NEXMO-APP-KEY',
        'nexmo_secret' => 'YOUR-NEXMO-APP-SECRET',
        'microsoft_bot_handle' => 'YOUR-MICROSOFT-BOT-HANDLE',
        'microsoft_app_id' => 'YOUR-MICROSOFT-APP-ID',
        'microsoft_app_key' => 'YOUR-MICROSOFT-APP-KEY',
        'slack_token' => 'YOUR-SLACK-TOKEN-HERE',
        'telegram_token' => 'YOUR-TELEGRAM-TOKEN-HERE',
        'facebook_token' => 'YOUR-FACEBOOK-TOKEN-HERE',
        'facebook_app_secret' => 'YOUR-FACEBOOK-APP-SECRET-HERE', // Optional - this is used to verify incoming API calls,
        'wechat_app_id' => 'YOUR-WECHAT-APP-ID',
        'wechat_app_key' => 'YOUR-WECHAT-APP-KEY',
    ],

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


    'google' => [
        'client_id' => '387571235902-7c60dhi7c4l3jiig7gqtuhfiptl7p11j.apps.googleusercontent.com',
        'client_secret' => 'BW3V6FkmzyPRjmzAHypWp_vn',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ], 
    
    /*
    'facebook' => [
        'client_id' => '1208357402870164',
        'client_secret' => '12897d065eb39dda4e2bbb1c2b57095c',
        'redirect' => 'http://localhost:8000/callback/facebook',
    ],
    */

    'facebook' => [
        'client_id' => '459985688701955',
        'client_secret' => '42c215e43b02efe1a233610aee14adbf',
        'redirect' => 'http://localhost:8000/callback/facebook',
    ],

    'twilio' => [
        'sid' => env('TWILIO_AUTH_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'whatsapp_from' => env('TWILIO_WHATSAPP_FROM')
      ]

];
