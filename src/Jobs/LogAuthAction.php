<?php

namespace Chrysanthos\AuthLogging\Jobs;

use Chrysanthos\AuthLogging\Models\AuthLogEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LogAuthAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $credentials;

    /**
     * Create a new job instance.
     *
     * @param $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->getEmail();

        $existing_user = DB::table('users')->where('email', $email)->exists();

        AuthLogEntry::create([
            'email'         => $email,
            'password'      => $this->getPassword(),
            'ip'            => $this->credentials['ip'],
            'user_agent'    => $this->credentials['user_agent'],
            'existing_user' => $existing_user,
        ]);
    }

    /**
     * @return string|null
     */
    protected function getEmail()
    {
        $value = $this->credentials['email'] ?? $this->credentials['username'] ?? null;

        if ($value === null) {
            return null;
        }

        $maskedFields = config('auth-logging.mask', []);

        return in_array('email', $maskedFields, true)
            ? $this->mask($value, (int) (strlen($value) / 2))
            : $this->credentials['email'];
    }

    /**
     * @return string
     */
    protected function getPassword()
    {
        $value        = $this->credentials['password'];
        $maskedFields = config('auth-logging.mask', []);

        return in_array('password', $maskedFields, true)
            ? $this->mask($value, (int) (strlen($value) / 2))
            : $this->credentials['password'];
    }

    /**
     * @param  string  $value  The value to be masked
     * @param  int  $number  The number of characters to be plain text
     *
     * @return string
     */
    protected function mask(string $value, $number)
    {
        return str_repeat('*', strlen($value) - $number).substr($value, -$number);
    }
}
