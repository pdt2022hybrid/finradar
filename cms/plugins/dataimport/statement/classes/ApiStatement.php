<?php namespace Dataimport\Statement\Classes;

use Appentities\Company\Models\Company;
use Appentities\Statement\Models\Statement;
use Dataimport\Statement\Classes\requests\StatementRequest;
use Dataimport\Report\Classes\Services\ApiService as ReportApiService;
use Exception;

class ApiStatement
{
    public $request;
    public $response;
    public $statement;

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->request = new StatementRequest($id);
        $this->response = $this->request->response;
    }

    public function company()
    {
        return Company::where('ico', $this->response['ico'])->first();
    }

    /**
     * @throws Exception
     */
    public function createStatement(): void
    {
        $this->statement = new Statement();
        $this->fillFromApi();
        $this->statement->company_id = $this->company()->id;

        if ($this->checkData()) {
            $this->statement->save();
        }
    }

    public function canCreateStatement(): bool
    {

        if (!$this->company()) {
            return false;
        }

        return true;
    }

    public function reports() {
        return $this->response['idUctovnychVykazov'] ?? false;
    }

    public function createReports(): void {
        if ($this->reports()) {
            foreach ($this->reports() as $report) {
                ReportApiService::importReport($report);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function fillFromApi(): void
    {
        $this->statement->official_id = $this->response['id'];
        $this->statement->ico = $this->response['ico'];

        if (array_has($this->response, ['obdobieOd', 'obdobieDo'])) {

            $year1 = substr($this->response['obdobieOd'], 0, 4);
            $year2 = substr($this->response['obdobieDo'], 0, 4);

            $month1 = substr($this->response['obdobieOd'], 5, 2);
            $month2 = substr($this->response['obdobieDo'], 5, 2);

            if ($year1 < 2015) {
                throw new Exception('Statement is too old');
            }

            if ($month1 == '01' && $month2 == '12' && $year1 == $year2) {
                $this->statement->year = $year1;
            }

        }


    }

    public function checkData():bool
    {
        foreach (['official_id', 'company_id', 'ico', 'year'] as $column) {
            if (empty($this->statement->$column)) {
                return false;
            }
        }

        return true;
    }

}
