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
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->app->register(ServiceProvider::class);
    }
}
