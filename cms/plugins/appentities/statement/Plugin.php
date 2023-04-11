<?php namespace Appentities\Statement;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'statement',
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
        return [
            'statement' => [
                'label' => 'statement',
                'url' => Backend::url('appentities/statement/statements'),
                'icon' => 'icon-bar-chart',
                'permissions' => ['appentities.statement.*'],
                'order' => 702,
            ],
        ];
    }
}
