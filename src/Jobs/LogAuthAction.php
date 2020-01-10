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
        $email = $this->credentials['email'] ?? $this->credentials['username'] ?? null;

        $existing_user = DB::table('users')->where('email', $email)->exists();

        AuthLogEntry::create([
            'email'         => $email,
            'password'      => $this->credentials['password'],
            'ip'            => $this->credentials['ip'],
            'user_agent'    => $this->credentials['user_agent'],
            'existing_user' => $existing_user,
        ]);
    }
}
