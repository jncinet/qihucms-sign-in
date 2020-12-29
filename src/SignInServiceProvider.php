<?php

namespace Qihucms\SignIn;

use Illuminate\Support\ServiceProvider;

class SignInServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('SignIn', function () {
            return new SignIn();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sign_in');
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/sign_in'),
        ]);
    }
}
