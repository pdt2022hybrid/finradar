<?php namespace Appentities\Company\Models;

use Carbon\Carbon;
use October\Rain\Database\Model;
use Laravel\Scout\Searchable;
use Appentities\Report\Models\Report;
use Appentities\Statement\Models\Statement;
use Appentities\Director\Models\Director;
use Appentities\Director\Models\CompanyDirector;
use October\Rain\Database\Relations\BelongsToMany;
use October\Rain\Database\Relations\HasMany;
use October\Rain\Support\Collection;

/**
 * Company Model
 *
 * @property int id
 * @property int official_id
 * @property string name
 * @property int ico
 * @property int dic
 * @property int legal_form
 * @property int ownership_type
 * @property string street
 * @property string city
 * @property string postal_zip
 * @property string date_of_establishment
 *
 * @property Report latest_report
 * @property int revenue
 * @property int profits
 * @property int assets_total
 * @property int liabilities_total
 * @property int capital
 * @property int year
 * @property int report_official_id
 * @property int statement_official_id
 *
 * @property Collection reports
 * @property Collection statements
 * @property Collection directors
 *
 * @method HasMany statements()
 * @method HasMany reports()
 * @method BelongsToMany directors()
 */
class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Searchable;

    public $table = 'apidata_companies';

    public $rules = [];

    public $hasMany = [
        'statements' => [
            Statement::class,
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
        'reports' => [
            Report::class,
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
    ];

    public $belongsToMany = [
        'directors' => [
            Director::class,
            'pivotModel' => CompanyDirector::class,
            'table' => 'apidata_company_director_pivot'
        ],
    ];

    public static function exists($query)
    {
        return self::where('official_id', $query)->orWhere('ico', $query)->exists();
    }

    public static function getYear(): int
    {
        return Carbon::now()->month < 6 ? Carbon::now()->year - 2 : Carbon::now()->year - 1;
    }

    public function getLatestReportAttribute(): Report
    {
        return $this->reports->sortByDesc('year')->first();
    }

    public function getRevenueAttribute(): int
    {
        return $this->latest_report->revenue;
    }

    public function getProfitsAttribute(): int
    {
        return $this->latest_report->profits;
    }

    public function getAssetsTotalAttribute(): int
    {
        return $this->latest_report->assets_total;
    }

    public function getLiabilitiesTotalAttribute(): int
    {
        return $this->latest_report->liabilities_total;
    }

    public function getCapitalAttribute(): int
    {
        return $this->latest_report->capital;
    }

// legacy
//    public function scopeJoinLatestReport($query)
//    {
//        return $query->joinSub(Report::where('year', self::getYear())->isNotEmpty(), 'latest_reports', function ($join) {
//            $join->on('apidata_companies.ico', '=', 'latest_reports.ico');
//        })->select('latest_reports.*', 'apidata_companies.*', 'apidata_companies.official_id as company_official_id', 'latest_reports.official_id as report_official_id');
//    }

}
