<?php

namespace Carro\Core;

use DateInterval;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\RequestGuard;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\PersonalAccessGrant;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Guards\TokenGuard;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Parser;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\ResourceServer;

class CarroCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    	if ($this->app->runningInConsole()) {
            $this->registerMigrations();

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'carro-core-migrations');

            $this->publishes([
                __DIR__.'/../config/carro-core.php' => config_path('carro-core.php'),
            ], 'carro-core-config');

            $this->commands([
                Console\InstallCommand::class
            ]);
        }
    }

    /**
     * Register Passport's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
    	$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/carro-core.php', 'carro-core');
    }

}