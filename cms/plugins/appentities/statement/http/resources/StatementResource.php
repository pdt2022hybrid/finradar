<?php namespace AppEntities\Statement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Report\Http\Resources\ReportResource;

class StatementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->official_id,
            'company' => [
                'id' => $this->resource->company->id,
                'ico' => $this->resource->company->ico,
            ],
            'year' => $this->resource->year,
            'reports' => $this->when($this->resource->reports, ReportResource::collection($this->resource->reports)),
        ];
    }
}
