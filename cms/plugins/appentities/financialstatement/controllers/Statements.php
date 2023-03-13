<?php namespace Appentities\Financialstatement\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Statements Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Statements extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relations.yaml';

    public $requiredPermissions = ['appentities.financialstatement.statements'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appentities.Financialstatement', 'financialstatement', 'statements');
    }
}
