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
            'otherKey' => 'ico',
        ],
    ];

    public $hasMany = [
        'reports' => [
            'Appentities\Financialreport\Models\Report',
            'key' => 'statement_id',
            'otherKey' => 'official_id',
        ],
    ];

    public $collumnsInApi = [
        'official_id' => 'id',
        'ico' => 'ico',
    ];

    public function fillFromApi($data):void
    {
        foreach ($this->collumnsInApi as $key => $value) {
            if (isset($data[$value])) {
                $this->$key = $data[$value];
            }
        }

        if (isset($data['obdobieOd']) && isset($data['obdobieDo'])) {

            $year1 = substr($data['obdobieOd'], 0, 4);
            $year2 = substr($data['obdobieDo'], 0, 4);

            $month1 = substr($data['obdobieOd'], 5, 2);
            $month2 = substr($data['obdobieDo'], 5, 2);

            if ($month1 == '01' && $month2 == '12' && $year1 == $year2) {
                $this->year = $year1;
            }

        }
    }

    public function checkData():bool
    {
        foreach (['official_id', 'company_id', 'ico', 'year'] as $column) {
            if (empty($this->$column)) {
                return false;
            }
        }

        return true;
    }
    public static function exists($id) {
        return self::where('official_id', $id)->exists();
    }
}
