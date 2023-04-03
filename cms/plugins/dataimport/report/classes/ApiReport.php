<?php namespace Dataimport\Report\classes;

use Appentities\Report\Models\Report;
use Appentities\Statement\Models\Statement;
use Dataimport\Report\classes\requests\ReportRequest;
use Exception;
use Dataimport\Report\classes\ApiTemplate;
use Log;

class ApiReport
{

    private $request;

    public $response;
    public $template;
    public $data;
    public $report;

    private array $columns = [
        'revenue',
        'profits',
        'assets_total',
        'lt_intangible_assets_total',
        'lt_tangible_assets_total',
        'lt_financial_assets_total',
        'st_receivables_total',
        'financial_accounts_total',
        'liabilities_total',
        'capital',
        'base_capital',
        'result_last_year',
        'profit_for_period_after_tax',
        'reserves',
        'st_liabilities',
        'bank_loans'
    ];

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->request = new ReportRequest($id); // makes request

        //set basic stuff
        $this->response = $this->request->response;
        $this->data = $this->request->response;

        $this->setTemplate();

    }

    /**
     * @throws Exception
     */
    private function setTemplate(): void
    {
        $this->template = new ApiTemplate($this->response['idSablony']); // create new api template
    }

    private function canCreateReport(): bool
    {
        if (!$this->statement()) {
            return false;
        }

        return true;
    }

    public function statement()
    {
        return Statement::where('official_id', $this->request->response['idUctovnejZavierky'])->first();
    }

    /**
     * @throws Exception
     */
    public function createReport(): Report
    {

        if (!$this->canCreateReport()) {
            throw new Exception('Cannot create report, canCreateReport returned false');
        }

        try {
            $this->report = new Report();
            $this->fillReportFromApi();
            $this->report->statement_id = $this->statement()->official_id;
            $this->report->save();
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getTraceAsString());
            Log::warning('Cannot create report, error happened when creating', ['data'=> $this->response]);
            throw new Exception('Cannot create report');
        }

        return $this->report;
    }

    /**
     * @throws Exception
     */
    public function fillReportFromApi(): void
    {

        if (!array_has($this->response, 'obsah')) {
            Log::warning('Cannot create report, missing obsah', ['data'=> $this->response]);
            throw new Exception('Cannot create report, missing obsah');
        }

        $this->report->official_id = array_get($this->response, 'id');
        $this->report->statement_id = array_get($this->response, 'idUctovnejZavierky');
        $this->report->ico = array_get($this->response, 'obsah.titulnaStrana.ico');
        $this->report->year = $this->getYear();

        if (!array_has($this->response, 'obsah.tabulky')) {
            Log::warning('Cannot create report, missing tabulky', ['data'=> $this->response]);
            throw new Exception('Cannot create report, missing tabulky');
        }

        foreach ($this->columns as $column) {
            $data_location = $this->template->getColumn($column);
            $row = array_get($data_location, 'row');


            $table = collect(array_get($this->response, 'obsah.tabulky'))->filter(function ($table) use ($data_location) {
                if (array_get($table, 'nazov.sk') == array_get($data_location, 'table_name')) {
                    return $table;
                }
            })->first();

            if (!$table) {
                Log::warning('Cannot create report, missing table', ['data'=> $this->response]);
                throw new Exception('Cannot create report, missing table');
            }

            $number = array_get($table, "data.$row", function () use ($table, $row, $column) {
                Log::warning('Defaulting to 0 on report data seed', ['id' => $this->report->official_id,'column' => $column,'data'=> $table, 'row' => $row]);
                return 0;
            });

            $this->report->{$column} = $number ? $number : 0;

        };

    }

    /**
     * @throws Exception
     */
    public function getYear() {
        if (array_has($this->response, 'obsah.titulnaStrana.obdobieOd') && array_has($this->response, 'obsah.titulnaStrana.obdobieDo')) {

            $year1 = substr(array_get($this->response, 'obsah.titulnaStrana.obdobieOd'), 0, 4);
            $year2 = substr(array_get($this->response, 'obsah.titulnaStrana.obdobieDo'), 0, 4);

            $month1 = substr(array_get($this->response, 'obsah.titulnaStrana.obdobieOd'), 5, 2);
            $month2 = substr(array_get($this->response, 'obsah.titulnaStrana.obdobieDo'), 5, 2);

            if ($month1 == '01' && $month2 == '12' && $year1 == $year2) {
                return $year1;
            }

        }
        else {
            Log::warning('Cannot get year, missing data', ['data'=> $this->response]);
            throw new Exception('Cannot get year');
        }
    }


}
