<?php namespace Appentities\Report\Models;

use October\Rain\Database\Model;
use Appentities\Company\Models\Company;
use Appentities\Statement\Models\Statement;

/**
 * Report Model
 *
 * @property int official_id
 * @property int statement_id
 * @property int ico
 * @property int year
 *
 * @property Company company
 * @property Statement statement
 *
 * @property int revenue
 * @property int profits
 * @property int assets_total
 * @property int liabilities_total
 * @property int capital
 *
 * @property int lt_intangible_assets_total
 * @property int lt_tangible_assets_total
 * @property int lt_financial_assets_total
 * @property int st_receivables_total
 * @property int financial_accounts_total
 *
 * @property int base_capital
 * @property int result_last_year
 * @property int profit_for_period_after_tax
 * @property int reserves
 * @property int st_liabilities
 * @property int bank_loans
 */
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
    public static function exists($id): bool
    {
        return self::where('official_id', $id)->exists();
    }

    public function scopeIsNotEmpty($query) {
        return $query; //TODO: do this
    }
}
