<?php

namespace Chrysanthos\AuthLogging\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AuthLogEntry extends Eloquent
{
    protected $table = 'auth_logs';

    protected $guarded = [];
}
