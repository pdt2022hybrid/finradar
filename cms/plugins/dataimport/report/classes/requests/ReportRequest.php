<?php namespace Dataimport\Report\classes\requests;

use Exception;
use Illuminate\Support\Facades\Http;

class ReportRequest
{

    static $url = 'https://www.registeruz.sk/cruz-public/api/uctovny-vykaz';

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
        $response = Http::get(self::$url, [
            'id' => $id,
        ]);

        if ($response->ok()) {
            $this->response = $response->json();
        } else {
            throw new Exception('Request failed');
        }
    }

}
