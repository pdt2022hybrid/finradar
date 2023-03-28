<?php namespace Dataimport\Statement\Classes\requests;

use Exception;
use Illuminate\Support\Facades\Http;

class StatementRequest
{

    static $url = 'https://www.registeruz.sk/cruz-public/api/uctovna-zavierka';

    public $response;
    public $company;

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
        $response = Http::get(self::$url, [
            'id' => $id,
        ]);

        if ($this->isResponseOk($response)) {
            $this->response = $response->json();
        } else {
            throw new Exception('Request failed');
        }
    }

    public function isResponseOk($response): bool
    {

        if (!$response->ok()) {
            return false;
        }
        if (!isset($response->json()['ico'])) {
            return false;
        }

        return true;
    }

}
