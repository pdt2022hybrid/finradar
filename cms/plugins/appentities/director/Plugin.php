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

    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'director' => [
                'label' => 'director',
                'url' => Backend::url('appentities/director/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appentities.director.*'],
                'order' => 500,
            ],
        ];
    }
}
