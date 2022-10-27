<?php

namespace Chrysanthos\AuthLogging\Listeners;

use Chrysanthos\AuthLogging\Jobs\LogAuthAction;
use Illuminate\Support\Facades\Request;

class AuthAttemptListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $payload = array_merge($event->credentials, [
            'ip'         => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);

        if (config('auth-logging.sync', true)) {
            dispatch(new LogAuthAction($payload));
        } else {
            dispatchSync(new LogAuthAction($payload));
        }
    }
}
