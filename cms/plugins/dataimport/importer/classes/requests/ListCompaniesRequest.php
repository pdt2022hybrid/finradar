<?php namespace Dataimport\Importer\classes\requests;

use Illuminate\Support\Facades\Http;
use Exception;

class ListCompaniesRequest
{

    static $url = 'https://www.registeruz.sk/cruz-public/api/uctovne-jednotky';

    private $request;

    public $response;

    /**
     * @throws Exception
     */
    public function __construct($last_id = 0, $refreshed_since = '2000-01-01', $max_records = 10000, $ico = null)
    {
        $this->request($last_id, $refreshed_since, $max_records, $ico);
    }

    /**
     * @throws Exception
     */
    public function request($last_id , $refreshed_since, $max_records, $ico = null): void
    {
        $params = [
            'pokracovat-za-id' => $last_id,
            'zmenene-od' => $refreshed_since,
            'max-zaznamov' => $max_records,
        ];

        if ($ico) {
            $params['ico'] = $ico;
        }

        $this->request = Http::get(self::$url, $params);

        if ($this->isRequestOk()) {
            $this->response = $this->request->json();
        } else {
            throw new Exception('Request failed');
        }
    }

    public function isRequestOk(): bool
    {

        if (!$this->request->ok()) {
            return false;
        }

        return true;
    }

    public function getLastId()
    {
        return collect($this->response['id'])->last();
    }

    public function getIds()
    {
        return $this->response['id'];
    }

}
