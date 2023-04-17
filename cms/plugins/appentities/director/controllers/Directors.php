<?php namespace Appentities\Director\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Directors extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    public $formConfig = 'config_form.yaml';

    public $listConfig = 'config_list.yaml';

    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['appentities.director.directors'];

    public function formExtendFields($form)
    {
        $form->addTabFields(
            [
                'companies' => [
                    'label' => 'Companies',
                    'type' => 'partial',
                    'path' => '$/appentities/director/controllers/directors/_field_companies.htm',
                ]
            ]
        );
    }

    public function listExtendColumns($list)
    {
        $list->addColumns([
            'companies' => [
                'label' => 'Companies',
                'relation' => 'companies',
                'select' => 'name',
            ]
        ]);
    }

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appentities.Director', 'director', 'directors');
    }
}
