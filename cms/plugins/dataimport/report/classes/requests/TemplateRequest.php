<?php namespace Dataimport\Report\classes\Requests;

use Illuminate\Support\Facades\Http;
use Exception;

class TemplateRequest
{

    static $url = 'https://www.registeruz.sk/cruz-public/api/sablona';

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
