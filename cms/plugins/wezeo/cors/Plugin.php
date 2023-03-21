<?php namespace Wezeo\CORS;

use System\Classes\PluginBase;
use Wezeo\CORS\Http\Middlewares\HandleCorsHeaders;

class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'CORS',
            'description' => 'No description provided yet...',
            'author' => 'Wezeo',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->app['Illuminate\Contracts\Http\Kernel']->prependMiddleware(HandleCorsHeaders::class);
    }
}
