<?php namespace Appentities\Company;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'company',
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
            'company' => [
                'label' => 'Companies',
                'url' => Backend::url('appentities/company/companies'),
                'icon' => 'icon-subway',
                'permissions' => ['appentities.company.*'],
                'order' => 701,
            ],
        ];
    }
}
