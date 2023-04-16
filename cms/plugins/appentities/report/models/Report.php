<?php namespace Appentities\Report\Models;

use October\Rain\Database\Model;

class Report extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_reports';
    public $rules = [];

    public $belongsTo = [
        'company' => [
            '\Appentities\Company\Models\Company',
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
        'statement' => [
            '\AppEntities\Statement\Models\Statement',
            'key' => 'statement_id',
            'otherKey' => 'official_id',
        ],
    ];

    /**
     * Checks if report has correct data
     * @return bool true if report has correct data, false otherwise
     */
    public function checkData(): bool
    {

        foreach (['official_id', 'statement_id', 'ico', 'year'] as $column) {
            if (empty($this->$column)) {
                echo "Column $column is empty";
                return false;
            }
        }

        return true;
    }

    /**
     * Checks if report with given id exists in database
     * @param $id
     * @return bool
     */
    public static function exists($id) {
        return self::where('official_id', $id)->exists();
    }

    public function scopeIsNotEmpty($query) {
        return $query; //TODO: do this
    }
}
