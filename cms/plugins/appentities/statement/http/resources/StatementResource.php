<?php namespace AppEntities\Statement\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use AppEntities\Report\Http\Resources\ReportResource;
use Appentities\Report\Models\Report;
use Appentities\Company\Models\Company;
use October\Rain\Support\Collection;

/**
 * Class StatementResource
 *
 * @property int official_id
 * @property int year
 * @property Company company
 * @property Collection reports
 *
 */
class StatementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->official_id,
            'company' => [
                'id' => $this->company->id,
                'ico' => $this->company->ico,
            ],
            'year' => $this->year,
            'reports' => $this->when((bool)$this->reports, ReportResource::collection($this->reports)),
        ];
    }
}
