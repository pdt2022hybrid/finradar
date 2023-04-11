<?php namespace Appuser\User;

use Backend;
use System\Classes\PluginBase;
use Appuser\User\Classes\Extend\UserExtend;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'user',
            'description' => 'No description provided yet...',
            'author' => 'appuser',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        UserExtend::addRelations();
    }

    public function registerNavigation()
    {

        return [
            'user' => [
                'label' => 'AppUser',
                'url' => Backend::url('appuser/user/dashboards'),
                'icon' => 'icon-user',
                'permissions' => ['appuser.user.*'],
                'order' => 500,
            ],
        ];
    }
}
