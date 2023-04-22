<?php namespace Appentities\Director\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Company\Http\Resources\CompanyResource;
use Appentities\Company\Models\Company;
use October\Rain\Support\Collection;

/**
 * Class DirectorResource
 * @property int id
 * @property string name
 * @property string street
 * @property string city
 * @property string number
 * @property string zip
 * @property Collection companies
 *
 * @method relationLoaded(string $relation)
 */
class DirectorResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'number' => $this->number,
            'zip' => $this->zip,
            'companies' => $this->when($this->relationLoaded('companies'), CompanyResource::collection(
                Company::whereIn('id', $this->companies->pluck('id'))->get()
            )),
        ];
    }

}
