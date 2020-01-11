<?php

namespace Chrysanthos\AuthLogging\Jobs;

use Chrysanthos\AuthLogging\Models\AuthLogEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogAuthAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payload;

    /**
     * Create a new job instance.
     *
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
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
            'ip'            => $this->payload['ip'] ?? null,
            'user_agent'    => $this->payload['user_agent'] ?? null,
            'existing_user' => $existing_user,
        ]);
    }

    /**
     * @return string|null
     */
    protected function getEmail()
    {
        $value = $this->payload['email'] ?? $this->payload['username'] ?? null;

        if ($value === null) {
            return;
        }

        $maskedFields = config('auth-logging.mask', []);

        return in_array('email', $maskedFields, true)
            ? $this->mask($value, (int) (strlen($value) / 2))
            : $this->payload['email'];
    }

    /**
     * @return string
     */
    protected function getPassword()
    {
        $value        = $this->payload['password'];
        $maskedFields = config('auth-logging.mask', []);

        return in_array('password', $maskedFields, true)
            ? $this->mask($value, (int) (strlen($value) / 2))
            : $this->payload['password'];
    }

    /**
     * @param  string  $value  The value to be masked
     * @param  int  $number  The number of characters to be plain text
     *
     * @return string
     */
    protected function mask(string $value, $number)
    {
        $length = strlen($value);

        if (Str::contains($value, '@')) {
            $length = strlen(Str::beforeLast($value, '@'));

            $number = (int) ($length / 2);
        }

        return str_repeat('*', $length - $number).substr($value, $number);
    }
}
