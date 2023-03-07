<?php namespace Appentities\Financialreport\Models;

use Model;

class Report extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_reports';
    public $rules = [];

    public $belongsTo = [
        'company' => [
            'Appentities\Company\Models\Company',
            'key' => 'ico',
            'otherKey' => 'company_id',
        ],
        'statement' => [
            'Appentities\FinancialStatement\Models\FinancialStatement',
            'key' => 'statement_id',
        ],
    ];
}
