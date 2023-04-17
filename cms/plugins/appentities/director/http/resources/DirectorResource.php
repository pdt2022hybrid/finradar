<?php namespace Appentities\Director\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Company\Http\Resources\CompanyResource;

class DirectorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'number' => $this->resource->number,
            'zip' => $this->resource->zip,
            'companies' => $this->when($this->resource->relationLoaded('companies'), CompanyResource::collection($this->resource->companies)),
        ];
    }

}
