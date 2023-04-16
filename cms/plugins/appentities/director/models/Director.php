<?php namespace Appentities\Director\Models;

use October\Rain\Database\Model;
use Appentities\Company\Models\Company;

class Director extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_directors';

    public $rules = [];

    public $fillable = [
        'name',
        'street',
        'city',
        'number',
        'zip',
    ];

    public $belongsToMany = [
        'companies' => [
            Company::class,
            'pivotModel' => CompanyDirector::class,
            'table' => 'apidata_company_director_pivot',
        ],
    ];

    /**
     * Check if director exists
     *
     * @param array|Director $director
     * @param boolean $returnId Return director id if exists
     * @return boolean|int
     */
    public static function exists(Director|array $director, bool $returnId): bool|int
    {
        if (is_array($director)) {
            $director = self::where('name', $director['name'])->where('street', $director['street'])->where('city', $director['city'])->where('number', $director['number'])->where('zip', $director['zip'])->first();
        }

        if ($director instanceof Director) {
            return $returnId ? $director->id : true;
        }

        return false;

    }
}
