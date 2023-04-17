<?php namespace Appentities\Company\Controllers;

use BackendMenu;
use Backend\Classes\Controller;


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

    public function formExtendFields($form)
    {
        $form->addTabFields(
            [
                'statements' => [
                    'label' => 'Statements',
                    'type' => 'partial',
                    'path' => '$/appentities/company/controllers/companies/_field_statements.htm',
                    'tab' => 'Statements'
                ],
                'reports' => [
                    'label' => 'Reports',
                    'type' => 'partial',
                    'path' => '$/appentities/company/controllers/companies/_field_reports.htm',
                    'tab' => 'Reports'
                ],
                'directors' => [
                    'label' => 'Directors',
                    'type' => 'partial',
                    'path' => '$/appentities/company/controllers/companies/_field_directors.htm',
                ]
            ]
        );
    }
}
