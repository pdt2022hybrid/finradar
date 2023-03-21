<?php namespace Dataimport\Report\classes;

use Appentities\Report\Models\Report;
use Appentities\Statement\Models\Statement;
use Dataimport\Report\classes\requests\ReportRequest;
use Exception;
use Dataimport\Report\classes\ApiTemplate;

class ApiReport
{

    private $request;

    public $response;
    public $template;
    public $data;

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
        $this->template = new ApiTemplate($this->response['idSablony']);
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
        return Statement::where('official_id', $this->request->response->json()['idUctovnejZavierky'])->first();
    }

    /**
     * @throws Exception
     */
    public function createReport(): Report
    {

        if (!$this->canCreateReport()) {
            throw new Exception('Cannot create report');
        }

        $report = new Report();
        $report->fillFromApi($this->response);
        $report->statement_id = $this->statement()->id;
        $report->save();

        return $report;
    }

}
