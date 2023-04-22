<?php namespace AppEntities\Company\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Report\Models\Report;
use Appentities\Director\Models\Director;
use Appentities\Statement\Models\Statement;
use AppEntities\Statement\Http\Resources\StatementResource;
use AppEntities\Report\Http\Resources\ReportResource;
use Appentities\Director\Http\Resources\DirectorResource;
use October\Rain\Support\Collection;

/**
 * Class CompanyResource
 *
 * @property string name
 * @property string|int company_official_id
 * @property int official_id
 * @property int ico
 * @property int dic
 * @property int legal_form
 * @property int ownership_type
 * @property string street
 * @property string city
 * @property string postal_zip
 * @property string date_of_establishment
 *
 * @property Report latest_report
 * @property int revenue
 * @property int profits
 * @property int assets_total
 * @property int liabilities_total
 * @property int capital
 * @property int year
 * @property int report_official_id
 * @property int statement_official_id
 *
 * @property Collection reports
 * @property Collection statements
 * @property Collection directors
 *
 * @method relationLoaded(string $relation)
 */
class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'official_id' => $this->company_official_id ?? $this->official_id,
            'ico' => $this->ico,
            'dic' => $this->dic,
            'legal_form' => $this->legal_form,
            'directors' => $this->when($this->relationLoaded('directors'), DirectorResource::collection($this->directors)),
            'address' => [
                'street' => $this->street,
                'city' => $this->city,
                'postal_zip' => $this->postal_zip,
            ],
            'date_of_establishment' => $this->date_of_establishment,
            'latest_data' => $this->when((bool)$this->latest_report, [
                'revenue' => $this->latest_report->revenue,
                'profits' => $this->latest_report->profits,
                'assets_total' => $this->latest_report->assets_total,
                'liabilities_total' => $this->latest_report->liabilities_total,
                'capital' => $this->latest_report->capital,
                'year' => $this->latest_report->year,
            ]),
            'latest_report' => $this->when((bool)$this->latest_report, new ReportResource($this->latest_report)),
            'graph_data' => [
                'revenue' => $this->when($this->relationLoaded('reports'), $this->reports->pluck('revenue', 'year')),
                'profits' => $this->when($this->relationLoaded('reports'), $this->reports->pluck('profits', 'year')),
            ],
            'statements' => $this->when($this->relationLoaded('statements'), StatementResource::collection($this->statements)),
        ];
    }
}
