<?php namespace AppEntities\Report\Http\Resources;

use Appentities\Company\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Statement\Models\Statement;

/**
 * Class ReportResource
 *
 * @property int official_id
 * @property Statement statement
 * @property int year
 * @property int revenue
 * @property int profits
 * @property int assets_total
 * @property int liabilities_total
 * @property int capital
 * @property int lt_intangible_assets_total
 * @property int lt_tangible_assets_total
 * @property int lt_intangible_assets
 * @property int lt_tangible_assets
 * @property int lt_financial_assets_total
 * @property int st_receivables_total
 * @property int financial_accounts_total
 * @property int base_capital
 * @property int result_last_year
 * @property int profit_for_period_after_tax
 * @property int reserves
 * @property int st_liabilities
 * @property int bank_loans
 */
class ReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->official_id,
            'statement' => [
                'id' => $this->statement->official_id,
            ],
            'company' => [
                'id' => $this->statement->company->official_id,
                'ico' => $this->statement->company->ico,
            ],
            'year' => $this->statement->year,
            'revenue' => number_format($this->revenue, 0, '.', ' '),
            'profits' => number_format($this->profits, 0, '.', ' '),
            'assets_total' => number_format($this->assets_total, 0, '.', ' '),
            'liabilities_total' => number_format($this->liabilities_total, 0, '.', ' '),
            'capital' => number_format($this->capital, 0, '.', ' '),
            'assets' => [
                'lt_intangible_assets_total' => number_format($this->lt_intangible_assets_total, 0, '.', ' '),
                'lt_tangible_assets_total' => number_format($this->lt_tangible_assets_total, 0, '.', ' '),
                'lt_financial_assets_total' => number_format($this->lt_financial_assets_total, 0, '.', ' '),
                'st_receivables_total' => number_format($this->st_receivables_total, 0, '.', ' '),
                'financial_accounts_total' => number_format($this->financial_accounts_total, 0, '.', ' '),
            ],
            'liabilities' => [
                'base_capital' => number_format($this->base_capital, 0, '.', ' '),
                'result_last_year' => number_format($this->result_last_year, 0, '.', ' '),
                'profit_for_period_after_tax' => number_format($this->profit_for_period_after_tax, 0, '.', ' '),
                'reserves' => number_format($this->reserves, 0, '.', ' '),
                'st_liabilities' => number_format($this->st_liabilities, 0, '.', ' '),
                'bank_loans' => number_format($this->bank_loans, 0, '.', ' '),
            ],
        ];
    }
}
