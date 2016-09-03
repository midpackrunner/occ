<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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

    'paypal' => [
        'client_id' => 'Ae8VvIlxK8c8Gz2nJndlU4pOX16rwd-zNYmgzsUnnGboMiScKTFYEI_dVI9ko7HCvdC6BZ8mswTrHEiw',
        'secret' => 'ELFqMdRwNjJcFOE5sAYK2TjY9CgKRGlcWIJOobenC6PNgxBqUGBERouQF_l-NuYhJbusbClsh7EWx9M-',
        'membership_return_url' => 'http://68.169.149.104/member_confirmation_pay_by_paypal',
        'membership_cancel_url' => 'http://68.169.149.104/member_cancel_pay_by_paypal',
        'membership_renewal_return_url' => 'http://68.169.149.104/member_renewal_confirmation_pay_by_paypal',
        'membership_renewal_cancel_url' => 'http://68.169.149.104/member_renewal_cancel_pay_by_paypal',
        'class_confirmation_paypal' => 'http://68.169.149.104/class_confirmation_paypal',
        'class_cancel_paypal' => 'http://68.169.149.104/class_cancel_paypal',
    ],

];
