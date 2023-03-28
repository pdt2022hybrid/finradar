<?php namespace AppEntities\Company\Http\Resources;

use Appentities\Report\Models\Report;
use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Statement\Http\Resources\StatementResource;
use AppEntities\Report\Http\Resources\ReportResource;

class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'official_id' => $this->resource->company_official_id ?? $this->resource->official_id,
            'ico' => $this->resource->ico,
            'dic' => $this->resource->dic,
            'legal_form' => $this->resource->legal_form,
            'address' => [
                'street' => $this->resource->street,
                'city' => $this->resource->city,
                'postal_zip' => $this->resource->postal_zip,
            ],
            'date_of_establishment' => $this->resource->date_of_establishment,
            'latest_data' => [
                'revenue' => $this->resource->revenue,
                'profits' => $this->resource->profits,
                'assets_total' => $this->resource->assets_total,
                'liabilities_total' => $this->resource->liabilities_total,
                'capital' => $this->resource->capital,
                'year' => $this->resource->year,
                'full_report' => $this->when($this->resource->report_official_id, ReportResource::make(Report::where('official_id', $this->resource->report_official_id)->first())),
            ],
            'statements' => $this->when($this->resource->relationLoaded('statements'), StatementResource::collection($this->resource->statements)),
        ];
    }
}
