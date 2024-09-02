<?php
/**
 * Masiv Client Library for PHP
 *
 * @copyright Copyright (c) 2020 W360, Inc. (https://lotous.com.co)
 * @license   https://github.com/lotous/elibom/blob/master/LICENSE MIT License
 */

namespace W360\Masiv;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository as Config;
use W360\Masiv\Client\Credentials\Basic;

class MasivServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config file path.
        $dist = __DIR__.'/../config/elibom.php';

        // If we're installing in to a Lumen project, config_path
        // won't exist so we can't auto-publish the config
        if (function_exists('config_path')) {
            // Publishes config File.
            $this->publishes([
                $dist => config_path('elibom.php'),
            ]);
        }

        // Merge config.
        $this->mergeConfigFrom($dist, 'elibom');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind Masiv Client in Service Container.
        $this->app->singleton(Client::class, function ($app) {
            return $this->createMasivClient($app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }

    /**
     * Create a new Masiv Client.
     *
     * @param Config $config
     *
     * @return Client
     *
     * @throws \RuntimeException
     */
    protected function createMasivClient(Config $config)
    {
        // Check for Masiv config file.
        if (! $this->hasMasivConfigSection()) {
            $this->raiseRunTimeException('Missing elibom configuration section.');
        }

        // Get Client Options.
        $options = array_diff_key($config->get('elibom'), ['api_key', 'api_secret', 'app', 'api_url', 'api_version']);

        $basicCredentials = null;
        if ($this->elibomConfigHas('api_key') && $this->elibomConfigHas('api_secret')) {
            $basicCredentials = $this->createBasicCredentials($config->get('elibom.api_key'), $config->get('elibom.api_secret'));
        }

        if($this->elibomConfigHasNo('api_key') or $this->elibomConfigHasNo('api_secret')){
            $this->raiseRunTimeException(
                'api key and secret key have no value assigned, please check your configuration file'
            );
        }

        if ($basicCredentials) {
            $credentials = $basicCredentials;
        } else {
            $possibleMasivKeys = [
                'api_key + api_secret',
            ];
            $this->raiseRunTimeException(
                'Please provide Masiv API credentials. Possible combinations: '
                . join(", ", $possibleMasivKeys)
            );
            return null;
        }

        $httpClient = null;
        if ($this->elibomConfigHas('http_client')) {
            $httpClient = $this->app->make($config->get(('elibom.http_client')));
        }

        return new Client($credentials, $options, $httpClient);
    }

    /**
     * Checks if has global Masiv configuration section.
     *
     * @return bool
     */
    protected function hasMasivConfigSection()
    {
        return $this->app->make(Config::class)
                         ->has('elibom');
    }

    /**
     * Checks if Masiv config does not
     * have a value for the given key.
     *
     * @param string $key
     *
     * @return bool
     */
    protected function elibomConfigHasNo($key)
    {
        return ! $this->elibomConfigHas($key);
    }

    /**
     * Checks if Masiv config has value for the
     * given key.
     *
     * @param string $key
     *
     * @return bool
     */
    protected function elibomConfigHas($key)
    {
        /** @var Config $config */
        $config = $this->app->make(Config::class);

        // Check for Masiv config file.
        if (! $config->has('elibom')) {
            return false;
        }

        return
            $config->has('elibom.'.$key) &&
            ! is_null($config->get('elibom.'.$key)) &&
            ! empty($config->get('elibom.'.$key));
    }

    /**
     * @param $key
     * @param $secret
     * @return Basic
     */
    protected function createBasicCredentials($key, $secret)
    {
        return new Basic($key, $secret);
    }

    /**
     * Raises Runtime exception.
     *
     * @param string $message
     *
     * @throws \RuntimeException
     */
    protected function raiseRunTimeException($message)
    {
        throw new \RuntimeException($message);
    }
}
