<?php namespace Dataimport\Company\Classes\Requests;

use Illuminate\Support\Facades\Http;
use Exception;

class CompanyRequest
{
    static $url = 'https://www.registeruz.sk/cruz-public/api/uctovna-jednotka';

    public $request;
    public $response;

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
        $this->request = Http::get(self::$url, [
            'id' => $id,
        ]);

        if ($this->isResponseOk()) {
            $this->response = $this->request->json();
        }
        else {
            throw new Exception('Request failed');
        }
    }

    public function isResponseOk(): bool
    {
        if (!$this->request->ok()) {
            return false;
        }
        if (array_has($this->response, 'ico')) {
            return false;
        }
        if (array_get($this->response, 'stav') == 'ZMAZANÉ') {
            return false;
        }

        return true;
    }

}
