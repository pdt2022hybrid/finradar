<?php namespace Appuser\User\Http\Resources;

use Appentities\Company\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Company\Http\Resources\CompanyResource;
use October\Rain\Support\Collection;

/**
 * Class DashboardResource
 * @property int id
 * @property int user_id
 * @property Collection companies
 *
 * @method relationLoaded(string $relation)
 */
class DashboardResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'companies' => $this->when((bool)$this->companies, CompanyResource::collection($this->companies)),
        ];
    }

}
