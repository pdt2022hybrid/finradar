<?php namespace Dataimport\Report\classes\requests;

use Exception;
use Illuminate\Support\Facades\Http;

class ReportRequest
{

    static $url = 'https://www.registeruz.sk/cruz-public/api/uctovny-vykaz';

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
        } else {
            throw new Exception('Request failed');
        }
    }

    public function isResponseOk(): bool
    {
        if (!$this->request->ok()) {
            return false;
        }
        if (!array_has($this->request->json(), 'obsah')) {
            return false;
        }

        return true;
    }

}
