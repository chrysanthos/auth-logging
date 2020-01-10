<?php

namespace Chrysanthos\AuthLogging;

use Chrysanthos\AuthLogging\Listeners\AuthAttemptListener;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AuthLoggingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if (config('auth-logging.enabled', true)) {
            Event::listen(
                Failed::class,
                AuthAttemptListener::class
            );
        }

        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/auth-logging.php' => config_path('auth-logging.php'),
            ], 'config');

            /*
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'auth-logging');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/chrysanthos/auth-logging'),
            ], 'views');
            */
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/auth-logging.php', 'auth-logging');
    }
}
