<?php namespace AppEntities\Company\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Financialstatement\Http\Resources\StatementResource;
use AppEntities\Financialreport\Http\Resources\ReportResource;

class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'ico' => $this->resource->ico,
            'dic' => $this->resource->dic,
            'address' => [
                'street' => $this->resource->street,
                'city' => $this->resource->city,
                'postal_zip' => $this->resource->postal_zip,
            ],
            'date_of_establishment' => $this->resource->date_of_establishment,
            'latest_data' => [
                'revenue' => $this->resource->latestRevenue,
                'profits' => $this->resource->latestProfits,
                'assets_total' => $this->resource->latestAssets,
                'liabilities_total' => $this->resource->latestLiabilities,
                'year' => $this->resource->latestYear,
                'full_report' => ReportResource::make($this->resource->latestReport),
            ],
            'statements' => $this->when($this->resource->relationLoaded('statements'), StatementResource::collection($this->resource->statements)),
        ];
    }
}
