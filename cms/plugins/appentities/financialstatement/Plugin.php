<?php namespace Appentities\Financialstatement;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'financialstatement',
            'description' => 'No description provided yet...',
            'author' => 'appentities',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Appentities\Financialstatement\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'appentities.financialstatement.some_permission' => [
                'tab' => 'financialstatement',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'financialstatement' => [
                'label' => 'financialstatement',
                'url' => Backend::url('appentities/financialstatement/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['appentities.financialstatement.*'],
                'order' => 500,
            ],
        ];
    }
}
