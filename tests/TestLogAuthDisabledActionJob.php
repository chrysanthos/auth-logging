<?php

namespace Chrysanthos\AuthLogging\Tests;

use Chrysanthos\AuthLogging\AuthLoggingServiceProvider;
use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase;

class TestLogAuthDisabledActionJob extends TestCase
{
    protected $credentials = ['email' => 'first@chrysanthos.dev', 'password' => 'password'];

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth-logging.enabled', false);
    }

    public function test_that_it_does_not_store_the_credentials_when_disabled()
    {
        $this->app['config']->set('auth-logging.mask', []);
        $this->migrate();

        $this->credentials = [
            'email'    => 'second@chrysanthos.dev',
            'password' => 'password',
        ];

        event(new Failed('web', $this->getUser(), $this->credentials));

        $this->assertDatabaseMissing('auth_logs', $this->credentials);
    }

    protected function getUser()
    {
        return tap(new User, function ($user) {
            $user->email = $this->credentials['email'];
            $user->password = $this->credentials['password'];

            return $user;
        });
    }

    protected function migrate(): void
    {
        $this->loadLaravelMigrations();
        $this->artisan('migrate')->run();
    }

    protected function getPackageProviders($app)
    {
        return [AuthLoggingServiceProvider::class];
    }
}
