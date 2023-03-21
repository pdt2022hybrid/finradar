<?php namespace Dataimport\Report\classes;

use Dataimport\Report\classes\Requests\TemplateRequest;
use Exception;

class ApiTemplate
{

    public $request;
    public $response;
    public $tables;

    private array $columns = [
        'revenue' => 'Výnosy z hospodárskej činnosti spolu súčet',
    ];

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->request($id);
    }

    /**
     * @throws Exception
     */
    public function request($id): void
    {
        $this->request = new TemplateRequest($id);
        $this->response = $this->request->response;
        $this->tables = collect($this->request->response['tabulky']);
    }

    public function getColumn()
    {

        $filtered = $this->tables->filter(function ($table) {
            $rows = collect($table['riadky']);
            $rows->filter(function ($row) {
                return $row['text']['sk'] === $this->columns['revenue'];
            });
            return $rows;
        });

        dd($filtered);

    }

}
