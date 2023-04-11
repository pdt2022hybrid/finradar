<?php namespace Appentities\Report;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'report',
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
            'report' => [
                'label' => 'report',
                'url' => Backend::url('appentities/report/reports'),
                'icon' => 'icon-line-chart',
                'permissions' => ['appentities.report.*'],
                'order' => 703,
            ],
        ];
    }
}
