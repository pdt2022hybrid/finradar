<?php namespace AppEntities\Company\Http\Resources;

use Appentities\Company\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;
use Appentities\Report\Models\Report;
use AppEntities\Statement\Http\Resources\StatementResource;
use AppEntities\Report\Http\Resources\ReportResource;
use Appentities\Director\Http\Resources\DirectorResource;
use October\Rain\Support\Collection;

/**
 * Class CompanyResource
 *
 * @mixin Company
 *
 * @property Report latest_report
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
                'revenue' => number_format($this->latest_report->revenue, 0, '.', ' '),
                'profits' => number_format($this->latest_report->profits, 0, '.', ' '),
                'assets_total' => number_format($this->latest_report->assets_total, 0, '.', ' '),
                'liabilities_total' => number_format($this->latest_report->liabilities_total, 0, '.', ' '),
                'capital' => number_format($this->latest_report->capital, 0, '.', ' '),
                'year' => $this->latest_report->year,
            ]),
            'latest_report' => $this->when((bool)$this->latest_report, new ReportResource($this->latest_report)),
            'graph_data' => [
                'revenue' => $this->when($this->relationLoaded('reports'), [
                    'labels' => $this->reports->pluck('year'),
                    'data' => $this->reports->pluck('revenue'),
                ]),
                'profits' => $this->when($this->relationLoaded('reports'), [
                    'labels' => $this->reports->pluck('year'),
                    'data' => $this->reports->pluck('profits'),
                ]),
                'assets' => $this->when($this->relationLoaded('reports'), [
                    [
                        'label' => 'Dlhodobý nehmotný majetok',
                        'value' => $this->latest_report->lt_intangible_assets_total,
                    ],
                    [
                        'label' => 'Dlhodobý hmotný majetok',
                        'value' => $this->latest_report->lt_tangible_assets_total,
                    ],
                    [
                        'label' => 'Dlhodobý finančný majetok',
                        'value' => $this->latest_report->lt_financial_assets_total,
                    ],
                    [
                        'label' => 'Krátkodobé pohľadávky',
                        'value' => $this->latest_report->st_receivables_total,
                    ],
                    [
                        'label' => 'Finančné účty',
                        'value' => $this->latest_report->assets_total,
                    ]
                ]),
                'liabilities' => $this->when($this->relationLoaded('reports'), [
                    [
                        'label' => 'Základné imanie',
                        'value' => $this->latest_report->base_capital,
                    ],
                    [
                        'label' => 'Výsledok hospodárenia minulého roku',
                        'value' => $this->latest_report->result_last_year,
                    ],
                    [
                        'label' => 'Výsledok hospodárenia predchádzajúceho účtovného obdobia',
                        'value' => $this->latest_report->profit_for_period_after_tax,
                    ],
                    [
                        'label' => 'Rezervy',
                        'value' => $this->latest_report->reserves,
                    ],
                    [
                        'label' => 'Krátkodobé záväzky',
                        'value' => $this->latest_report->st_liabilities,
                    ],
                    [
                        'label' => 'Bankové úvery',
                        'value' => $this->latest_report->bank_loans,
                    ],
                ]),
            ],
            'statements' => $this->when($this->relationLoaded('statements'), StatementResource::collection($this->statements)),
        ];
    }
}
