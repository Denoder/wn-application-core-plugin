# wn-application-core-plugin

This is an attempt to replace https://github.com/Teranode/winter-laravel-auth-bridge without the need to manually change files in your winter installation. It retains the same classes and aliases used in the application foundation as the auth bridge. The need for the Kernel file has been removed because you can always push your moddileware via the boot function.

You can override the default bindings by re-registering the binding in your Plugin.php file

```php 
$this->app->singleton('application.core.loader', function ($app) {
    $bindings = new \Application\Core\Classes\Bindings($app, [
        'redis.connection' => [\Illuminate\Redis\Connections\Connection::class, \Illuminate\Contracts\Redis\Connection::class],
    ]);

    $bindings->registerBindings();
});
```
