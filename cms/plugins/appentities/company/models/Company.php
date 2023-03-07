<?php namespace Appentities\Company\Models;

use Model;

/**
 * Company Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'apidata_companies';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'statements' => [
            'Appentities\FinancialStatement\Models\FinancialStatement',
            'key' => 'ico',
            'otherKey' => 'company_id',
        ],
        'reports' => [
            'Appentities\FinancialReport\Models\FinancialReport',
            'key' => 'ico',
            'otherKey' => 'company_id',
        ],
    ];

    public $collumnsInApi = [
        'official_id' => 'id',
        'ico' => 'ico',
        'dic' => 'dic',
        'legal_form' => 'pravnaForma',
        'ownership_type' => 'druhVlastnictva',
        'name' => 'nazovUJ',
        'street' => 'ulica',
        'city' => 'mesto',
        'postal_zip' => 'psc',
        'date_of_establishment' => 'datumZalozenia',
    ];

    public function fillFromApi($data): void
    {

        foreach ($this->collumnsInApi as $key => $value) {
            if (isset($data[$value])) {
                $this->$key = $data[$value];
            }
        }

    }

    public function afterCreate()
    {
        //refresh data
    }

    public static function exists($id) {
        return self::where('official_id', $id)->exists();
    }
}
