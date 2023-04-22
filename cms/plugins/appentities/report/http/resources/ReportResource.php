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
            'revenue' => $this->revenue,
            'profits' => $this->profits,
            'assets_total' => $this->assets_total,
            'liabilities_total' => $this->liabilities_total,
            'capital' => $this->capital,
            'assets' => [
                'lt_intangible_assets_total' => $this->lt_intangible_assets_total,
                'lt_tangible_assets_total' => $this->lt_tangible_assets_total,
                'lt_financial_assets_total' => $this->lt_financial_assets_total,
                'st_receivables_total' => $this->st_receivables_total,
                'financial_accounts_total' => $this->financial_accounts_total,
            ],
            'liabilities' => [
                'base_capital' => $this->base_capital,
                'result_last_year' => $this->result_last_year,
                'profit_for_period_after_tax' => $this->profit_for_period_after_tax,
                'reserves' => $this->reserves,
                'st_liabilities' => $this->st_liabilities,
                'bank_loans' => $this->bank_loans,
            ],
        ];
    }
}
