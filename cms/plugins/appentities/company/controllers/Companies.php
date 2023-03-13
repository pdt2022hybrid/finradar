<?php namespace Appentities\Company\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Companies Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Companies extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['appentities.company.companies'];

    public $relationConfig = '$/appentities/company/controllers/companies/config_relations.yaml';

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appentities.Company', 'company', 'companies');
    }

    public function listExtendQuery($query)
    {
        $query->joinLatestReport();
    }

    public function formExtendQuery($query)
    {
        $query->joinLatestReport();
    }
}
