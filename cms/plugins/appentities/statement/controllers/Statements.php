<?php namespace Appentities\Statement\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
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
    public $requiredPermissions = ['appentities.statement.statements'];
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appentities.Statement', 'statement', 'statements');
    }

    public function formExtendFields($form) {
        $form->addFields([
            'reports' => [
                'label' => 'Financial reports',
                'type' => 'partial',
                'path' => '$/appentities/statement/controllers/statements/_field_reports.htm',
            ],
        ]);
    }
}
