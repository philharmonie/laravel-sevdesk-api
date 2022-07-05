<?php
/*
 * config.php
 * @author Martin Appelmann <hello@martin-appelmann.de>
 * @copyright 2021 Martin Appelmann
 */

return [
    /*
     * Your sevdesk api token.
     */
    'api_token' => env('SEVDESK_API_TOKEN', ''),

    /*
     * Your paypal email address
     * Per default this will not be used unless you set the paypalAllowed flag to true in Exlo89\LaravelSevdeskApi\Api\Models\SevDeslInvoice.
     */
    'paypal_email_address' => env('SEVDESK_PAYPAL_EMAIL_ADDRESS', 'mail@example.com'),
];
