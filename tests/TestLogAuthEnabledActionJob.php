<?php

namespace Chrysanthos\AuthLogging\Tests;

use Chrysanthos\AuthLogging\AuthLoggingServiceProvider;
use Illuminate\Auth\Events\Failed;
use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase;

class TestLogAuthEnabledActionJob extends TestCase
{
    protected $credentials = ['email' => 'first@chrysanthos.dev', 'password' => 'password'];

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth-logging.enabled', true);
    }

    public function test_that_it_stores_the_credentials_when_enabled()
    {
        $this->app['config']->set('auth-logging.mask', []);

        $this->migrate();

        event(new Failed('web', $this->getUser(), $this->credentials));

        $this->assertDatabaseHas('auth_logs', $this->credentials);
    }

    public function test_that_it_masks_fields_successfully()
    {
        $this->app['config']->set('auth-logging.mask', ['email', 'password']);
        $this->migrate();

        $this->credentials = [
            'email' => 'second@chrysanthos.dev',
            'password' => 'password',
        ];

        event(new Failed('web', $this->getUser(), $this->credentials));

        $this->assertDatabaseHas('auth_logs', [
            'email' => '***ond@chrysanthos.dev',
            'password' => '****word',
        ]);
    }

    public function test_that_it_masks_selected_field_successfully()
    {
        $this->app['config']->set('auth-logging.mask', ['password']);
        $this->migrate();

        $this->credentials = [
            'email' => 'second@chrysanthos.dev',
            'password' => 'password',
        ];

        event(new Failed('web', $this->getUser(), $this->credentials));

        $this->assertDatabaseHas('auth_logs', [
            'email' => 'second@chrysanthos.dev',
            'password' => '****word',
        ]);
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
