<?php namespace Appentities\Company\Models;

use Carbon\Carbon;
use October\Rain\Database\Model;
use Laravel\Scout\Searchable;
use Appentities\Report\Models\Report;
use Appentities\Statement\Models\Statement;
use Appentities\Director\Models\Director;
use Appentities\Director\Models\CompanyDirector;

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

    public function getLatestReport()
    {
        return $this->reports->sortByDesc('year')->first();
    }

    public function scopeJoinLatestReport($query)
    {
        return $query->joinSub(Report::where('year', self::getYear())->isNotEmpty(), 'latest_reports', function ($join) {
            $join->on('apidata_companies.ico', '=', 'latest_reports.ico');
        })->select('latest_reports.*', 'apidata_companies.*', 'apidata_companies.official_id as company_official_id', 'latest_reports.official_id as report_official_id');
    }

}
