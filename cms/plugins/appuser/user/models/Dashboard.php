<?php namespace Appuser\User\models;

use Model;

class Dashboard extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'appuser_dashboards';

    public $rules = [];

    public $jsonable = [
        'companies'
    ];

    public $belongsTo = [
        'user' =>
            'LibUser\UserApi\Models\User',
            'key' => 'user_id',
            'otherKey' => 'id',
    ];

    public $belongsToMany = [
        'companies' => [
            'Appentities\Company\Models\Company',
            'table' => 'appuser_dashboards_companies',
        ]
    ];

    public function beforeCreate()
    {
        if (auth()->user()) {
            $this->user_id = auth()->user()->id;
        }
    }

}
