<?php namespace Appentities\Company\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
 */
class Company extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Searchable;

    public $table = 'apidata_companies';

    public $rules = [];

    public $hasOne = [
        'latest_report' => [
            Report::class,
            'key' => 'ico',
            'otherKey' => 'ico',
            'order' => 'year DESC'
        ],
    ];

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
        return self::where('official_id', $query)->orWhere('ico', $query)->get()->exists();
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

    public function scopeHasReports(Builder $query): Builder
    {
        return $query->whereHas('reports');
    }

    public function scopeOrderByReportData(Builder $query, string $column = 'revenue', string $order = 'desc'): Builder
    {

        return $query->selectSub(function ($query) use ($column, $order) {
            $query->from('apidata_reports AS reports')
                ->whereRaw('apidata_companies.ico = reports.ico')
                ->orderBy("reports.$column", $order)
                ->orderByDesc('reports.year')
                ->limit(1)
                ->select("reports.$column");
        }, 'latest_report_column')
            ->orderBy("latest_report_column", $order)
            ->addSelect('apidata_companies.*');

    }

    public function scopeFilterByReportData(Builder $query, string $column, string $operator, int $value): Builder
    {
        return $query->whereHas('reports', function ($query) use ($column, $operator, $value) {
            $query->where('year', function ($query) {
                $query->from('apidata_reports AS reports')
                    ->whereRaw('apidata_companies.ico = reports.ico')
                    ->orderByDesc('reports.year')
                    ->limit(1)
                    ->select('reports.year');
            });
            $query->where($column, $operator, $value);
        })->addSelect('apidata_companies.*');
    }

}
