<?php namespace Dataimport\Company\Classes\Requests;

use Carbon\Carbon;
use lubosdz\parserOrsr\ConnectorOrsr;
use Illuminate\Support\Facades\Cache;

class OrsrCompanyRequest
{

    public $data;
    private $orsr;

    public function __construct($ico)
    {
        $this->orsr = new ConnectorOrsr();
        $this->request($ico);
    }

    public function request($ico): void
    {
        if (Cache::has("orsr.company.$ico")) {
            $this->data = Cache::get("orsr.company.$ico");
            return;
        }

        if (
            Cache::has('orsr.last_request') &&
            Carbon::now()->diffInSeconds(Cache::get('orsr.last_request')) < 5
        ) {
            sleep(Carbon::now()->diffInSeconds(Cache::get('orsr.last_request')));
        }

        $this->data = $this->orsr->getDetailByICO($ico);

        Cache::put('orsr.last_request', Carbon::now(), 20);
        Cache::put("orsr.company.$ico", $this->data, Carbon::now()->addMonths(3));
    }

}
