<?php

return [

    'enabled' => env('AUTH_LOGGING', true),

    /*
    |--------------------------------------------------------------------------
    | Insert row into database synchronously
    |--------------------------------------------------------------------------
    |
    | Allows to specify whether your want to insert the query  synchronously
    | or whether is should be queued for faster response times.
    |
    */
    'sync'    => true,

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
