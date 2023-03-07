<?php namespace Appentities\Financialstatement\Models;

use Model;

class Statement extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_statements';

    public $rules = [];

    public $belongsTo = [
        'company' => [
            'Appentities\Company\Models\Company',
            'key' => 'ico',
            'otherKey' => 'company_id',
        ],
    ];

    public $hasMany = [
        'reports' => [
            'Appentities\FinancialReport\Models\FinancialReport',
            'key' => 'statement_id',
        ],
    ];
}
