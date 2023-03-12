<?php namespace Appentities\Financialreport\Models;

use Model;

class Report extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_reports';
    public $rules = [];

    public $belongsTo = [
        'company' => [
            'Appentities\Company\Models\Company',
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
        'statement' => [
            'Appentities\Financialstatement\Models\Statement',
            'key' => 'statement_id',
            'otherKey' => 'official_id',
        ],
    ];

    /**
     * Stores columns fillable from API response and the keys of the columns in the api response
     * @var array
     */
    private array $columnsInApi = [
        'official_id' => 'id',
        'statement_id' => 'idUctovnejZavierky',
    ];

    /**
     * Stores columns fillable from API response and the keys of the columns in the api response (for profit and loss table)
     * @var array
     */
    private array $profitLossColumnsInApi = [
        'revenue' => 1,
        'profits' => 71,
    ];

    /**
     * Stores columns fillable from API response and the keys of the columns in the api response (for assets table)
     * @var array
     */
    private array $assetColumnsInApi = [
        'assets_total' => 0,
        'lt_intangible_assets_total' => 4,
        'lt_tangible_assets_total' => 6,
        'lt_financial_assets_total' => 16,
        'st_receivables_total' => 32,
        'financial_accounts_total' => 40
    ];

    /**
     * Stores columns fillable from API response and the keys of the columns in the api response (for liabilities able)
     * @var array
     */
    private array $liabilityColumnsInApi = [
        'liabilities_total' => 0,
        'capital' => 2,
        'base_capital' => 4,
        'result_last_year' => 15,
        'profit_for_period_after_tax' => 17,
        'reserves' => 37,
        'st_liabilities' => 27,
        'bank_loans' => 39
    ];

    private array $numberColumns = [
        'revenue',
        'profits',
        'assets_total',
        'lt_intangible_assets_total',
        'lt_tangible_assets_total',
        'lt_financial_assets_total',
        'st_receivables_total',
        'financial_accounts_total',
        'liabilities_total',
        'capital',
        'base_capital',
        'result_last_year',
        'profit_for_period_after_tax',
        'reserves',
        'st_liabilities',
        'bank_loans'
    ];

    public function fillFromApi($data):void
    {
        foreach ($this->columnsInApi as $column => $key) {
            if (isset($data[$key])) {
                $this->$column = $data[$key];
            }
        }

        if (isset($data['obsah'])) {
            if (isset($data['obsah']['titulnaStrana'])) { // this code determines the year of the report, it is here because the api returns two values (start, end) and also included the months which are always the same 1 and 12

                $this->ico = $data['obsah']['titulnaStrana']['ico'];

                if (isset($data['obsah']['titulnaStrana']['obdobieOd']) && isset($data['obsah']['titulnaStrana']['obdobieDo'])) {

                    $year1 = substr($data['obsah']['titulnaStrana']['obdobieOd'], 0, 4);
                    $year2 = substr($data['obsah']['titulnaStrana']['obdobieDo'], 0, 4);

                    $month1 = substr($data['obsah']['titulnaStrana']['obdobieOd'], 5, 2);
                    $month2 = substr($data['obsah']['titulnaStrana']['obdobieDo'], 5, 2);

                    if ($month1 == '01' && $month2 == '12' && $year1 == $year2) {
                        $this->year = $year1;
                    }

                }
            }

            if (isset($data['obsah']['tabulky'])) {

                // very stupid code below, but it is needed because the api returns the data in standard arrays and not associative arrays, so I have to use the keys to get the data

                $tables = $data['obsah']['tabulky'];

                if (isset($tables[2])) {
                    $tables_profits_and_losses = $tables[2]['data'];

                    foreach ($this->profitLossColumnsInApi as $column => $key) {
                        if (isset($tables_profits_and_losses[$key])) {
                            $this->$column = $tables_profits_and_losses[$key];
                        }
                    }
                }

                if (isset($tables[0])) {
                    $tables_aseets = $tables[0]['data'];

                    foreach ($this->assetColumnsInApi as $column => $key) {
                        if (isset($tables_aseets[$key])) {
                            $this->$column = $tables_aseets[$key];
                        }
                    }
                }


                if (isset($tables[1])) {
                    $tables_liabilities = $tables[1]['data'];

                    foreach ($this->liabilityColumnsInApi as $column => $key) {
                        if (isset($tables_liabilities[$key])) {
                            $this->$column = $tables_liabilities[$key];
                        }
                    }
                }

            }

            foreach ($this->numberColumns as $column) {
                if (!isset($this->$column) || $this->$column == "") {
                    $this->$column = 0;
                }
            }

        }
    }

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
}
