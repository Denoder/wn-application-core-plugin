<?php 

namespace Application\Core;

use System\Classes\PluginBase;

/**
 * Core Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'WinterCMS Application Core Loader',
            'description' => '',
            'author'      => 'Christian McQuilkin',
            'icon'        => 'icon-key'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ServiceProvider::class);
        $this->app->register(\Illuminate\Auth\AuthServiceProvider::class);
    }
}
