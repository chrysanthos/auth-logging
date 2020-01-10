<?php

return [
    'enabled' => env('AUTH_LOGGING', true),

    'sync' => true,

    /*
    |--------------------------------------------------------------------------
    | Masked fields
    |--------------------------------------------------------------------------
    |
    | The values to be masked before inserted into the database.
    | Available columns to be masked: email, password
    |
    */

    'mask' => ['password'],

];
