<?php namespace Appuser\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Company\Http\Resources\CompanyResource;

class DashboardResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->user_id,
            'companies' => $this->when($this->resource->companies, CompanyResource::collection($this->resource->companies)),
        ];
    }

}
