<?php namespace Dataimport\Importer;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'importer',
            'description' => 'No description provided yet...',
            'author' => 'dataimport',
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

}
