<?php namespace Appentities\Director;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'director',
            'description' => 'No description provided yet...',
            'author' => 'appentities',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }

    public function registerNavigation(): array
    {
        return [
            'director' => [
                'label' => 'Directors',
                'url' => Backend::url('appentities/director/directors'),
                'icon' => 'icon-group',
                'permissions' => ['appentities.director.*'],
                'order' => 700,
            ],
        ];
    }
}
