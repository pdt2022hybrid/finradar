<?php namespace Appentities\Company\Models;

use Model;
use Laravel\Scout\Searchable;
use Appentities\Financialreport\Models\Report;

class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Searchable;

    public $table = 'apidata_companies';

    public $rules = [];

    public $hasMany = [
        'statements' => [
            'Appentities\Financialstatement\Models\Statement',
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
        'reports' => [
            'Appentities\Financialreport\Models\Report',
            'key' => 'ico',
            'otherKey' => 'ico',
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

    public static function exists($query) {
        return self::where('official_id', $query)->orWhere('ico', $query)->exists();
    }

    public function getLatestReport()
    {
        return $this->reports->sortByDesc('year')->first();
    }

    public function getLatestYearAttribute(): int
    {
        return $this->getLatestReport()->year ?? 0;
    }

    public function getLatestRevenueAttribute(): int
    {
        return $this->getLatestReport()->revenue ?? 0;
    }

    public function getLatestProfitsAttribute(): int
    {
        return $this->getLatestReport()->profits ?? 0;
    }

    public function getLatestAssetsAttribute(): int
    {
        return $this->getLatestReport()->assets_total ?? 0;
    }

    public function getLatestLiabilitiesAttribute(): int
    {
        return $this->getLatestReport()->profits_total ?? 0;
    }

    public function getLatestCapitalAttribute(): int
    {
        return $this->getLatestReport()->capital ?? 0;
    }

    public function getLatestReportAttribute()
    {
        return $this->getLatestReport();
    }

    public function afterSave()
    {

    }

}
