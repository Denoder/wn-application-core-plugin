<?php

namespace Application\Core;

use Application\Core\Classes\Bindings;
use Winter\Storm\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

    /**
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
     *
     * @return void
     */
    public function register()
    {
        $this->registerClassLoader();
    }

    /**
     * Method to register the Class Loader.
     *
     * @return void
     */
    protected function registerClassLoader() 
    {
        $this->app->singleton('application.core.loader', function($app) {
            return new Bindings($app);
        });

        $this->app['application.core.loader']->registerBindings();
    }
}