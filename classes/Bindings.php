<?php

namespace Application\Core\Classes;

use Winter\Storm\Foundation\Application;

/**
 * Bindings Class
 * 
 * Register the Loader and it's binsings. You can override this register by calling another instacne of the core loader in
 * the boot area of your plugin.
 * 
 * $this->app->singleton('application.core.loader', function ($app) {
 *     $bindings = new \Application\Core\Classes\Bindings($app, [
 *         'redis.connection' => [\Illuminate\Redis\Connections\Connection::class, \Illuminate\Contracts\Redis\Connection::class],
 *     ]);
 *
 *     $bindings->registerBindings();
 * });
 */
class Bindings {

    /**
     * The application instance.
     *
     * @var \Winter\Storm\Foundation\Application
     */
    protected $app;

    /**
     * Array to use to specify the classes to bind.
     *
     * @var Array
     */
    protected Array $singletons = [];

    /**
     * Array to use to specify the classes to bind.
     *
     * @var Array
     */
    protected Array $instances = [];

    /**
     * Constructor
     *
     * @param Application $app
     * @param array $singletons
     * @param array $instances
     */
    public function __construct(Application $app, Array $singletons = [], Array $instances = [])
    {
        $this->app = $app;
        $this->singletons = $singletons;
        $this->instances = $instances;
    }

    /**
     * Get aliases and class names to be used in a singleton function.
     *
     * @return Array
     */
    protected function getSingletons(): Array
    {
        return array_merge([
            'auth'                 => [\Illuminate\Auth\AuthManager::class, \Illuminate\Contracts\Auth\Factory::class],
            'auth.driver'          => [\Illuminate\Contracts\Auth\Guard::class],
            'cache.store'          => [\Illuminate\Cache\Repository::class, \Illuminate\Contracts\Cache\Repository::class, \Psr\SimpleCache\CacheInterface::class],
            'cache.psr6'           => [\Symfony\Component\Cache\Adapter\Psr16Adapter::class, \Symfony\Component\Cache\Adapter\AdapterInterface::class, \Psr\Cache\CacheItemPoolInterface::class],
            'hash'                 => [\Illuminate\Hashing\HashManager::class],
            'hash.driver'          => [\Illuminate\Contracts\Hashing\Hasher::class],
            'log'                  => [\Illuminate\Log\LogManager::class, \Psr\Log\LoggerInterface::class],
            'auth.password'        => [\Illuminate\Auth\Passwords\PasswordBrokerManager::class, \Illuminate\Contracts\Auth\PasswordBrokerFactory::class],
            'auth.password.broker' => [\Illuminate\Auth\Passwords\PasswordBroker::class, \Illuminate\Contracts\Auth\PasswordBroker::class],
            'redis.connection'     => [\Illuminate\Redis\Connections\Connection::class, \Illuminate\Contracts\Redis\Connection::class],
        ], $this->singletons);
    }

    /**
     * Get aliases and class names to be used in a bind function.
     *
     * @return Array
     */
    protected function getInstances(): Array
    {
        return array_merge([], $this->instances);
    }

    /**
     * Register Singletons and Instances
     *
     * @return void
     */
    public function registerBindings(): Void
    {
        foreach($this->getSingletons() as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->app->singleton($alias);
                $this->app->alias($key, $alias);
            }
        }

        foreach($this->getInstances() as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->app->singleton($alias);
                $this->app->alias($key, $alias);
            }
        }
    }
}