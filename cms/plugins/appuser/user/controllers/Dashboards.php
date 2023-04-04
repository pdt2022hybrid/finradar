<?php

namespace Appuser\User\controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Dashboards extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['appuser.user.dashboards'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appuser.User', 'user', 'dashboards');
    }
}
