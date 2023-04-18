<?php namespace Appentities\Director\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Company\Http\Resources\CompanyResource;
use Appentities\Company\Models\Company;

class DirectorResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'number' => $this->resource->number,
            'zip' => $this->resource->zip,
            'companies' => $this->when($this->resource->relationLoaded('companies'), CompanyResource::collection(
                Company::whereIn('id', $this->resource->companies->pluck('id'))->joinLatestReport()->get()
            )),
        ];
    }

}
