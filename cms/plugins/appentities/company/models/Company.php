<?php namespace Appentities\Company\Models;

use Carbon\Carbon;
use Model;
use Laravel\Scout\Searchable;
use Appentities\Report\Models\Report;

class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Searchable;

    public $table = 'apidata_companies';

    public $rules = [];

    public $hasMany = [
        'statements' => [
            'Appentities\Statement\Models\Statement',
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
        'reports' => [
            'Appentities\Report\Models\Report',
            'key' => 'ico',
            'otherKey' => 'ico',
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
