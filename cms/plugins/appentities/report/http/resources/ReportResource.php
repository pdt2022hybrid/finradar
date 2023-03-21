<?php namespace AppEntities\Financialreport\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->official_id,
            'statement' => [
                'id' => $this->resource->statement->official_id,
            ],
            'company' => [
                'id' => $this->resource->statement->company->id,
                'ico' => $this->resource->statement->company->ico,
            ],
            'year' => $this->resource->statement->year,
            'revenue' => $this->resource->revenue,
            'profits' => $this->resource->profits,
            'assets_total' => $this->resource->assets_total,
            'liabilities_total' => $this->resource->liabilities_total,
            'capital' => $this->resource->capital,
            'assets' => [
                'lt_intangible_assets_total' => $this->resource->lt_intangible_assets_total,
                'lt_tangible_assets_total' => $this->resource->lt_tangible_assets_total,
                'lt_financial_assets_total' => $this->resource->lt_financial_assets_total,
                'st_receivables_total' => $this->resource->st_receivables_total,
                'financial_accounts_total' => $this->resource->financial_accounts_total,
            ],
            'liabilities' => [
                'base_capital' => $this->resource->base_capital,
                'result_last_year' => $this->resource->result_last_year,
                'profit_for_period_after_tax' => $this->resource->profit_for_period_after_tax,
                'reserves' => $this->resource->reserves,
                'st_liabilities' => $this->resource->st_liabilities,
                'bank_loans' => $this->resource->bank_loans,
            ],
        ];
    }
}
