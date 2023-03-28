<?php namespace Dataimport\Importer\classes;

use App;
use Illuminate\Support\Facades\Http;
use Dataimport\Importer\classes\requests\ListCompaniesRequest;
use DataImport\Company\Classes\services\ApiService as CompanyApiService;
use Exception;
use Cache;
use Carbon\Carbon;
use Appentities\Company\Models\Company;
use Log;

class Import
{

    public static function hardRefresh()
    {
        set_time_limit(180);
        self::refresh();

        return 200; //TODO: proper 200 OK response
    }

    public static function gracefulRefresh()
    {
        set_time_limit(180);
        self::refresh(self::getLastCompany(), self::getLastRefresh());

        return 200;
    }

    public static function specificRefresh($ico)
    {
        set_time_limit(180);
        self::refresh(0, '2000-01-01', 100, $ico);

        return 200;
    }

    public static function refresh($last_id = 0, $refreshed_since = '2000-01-01', $max_records = 10000, $ico = null): void
    {

        $tries = 0;
        $should_continue = true;
        do {
            try {
                $request = new ListCompaniesRequest($last_id, $refreshed_since, $max_records, $ico);
                foreach ($request->getIds() as $id) {
                    CompanyApiService::importCompany($id);
                }
                $should_continue = $request->shouldContinue();
            } catch (Exception $e) {
                Log::error($e);
                $tries++;
                if ($tries > 5) {
                    break;
                }
                else {
                    continue;
                }
            }

        } while (
            $should_continue == true
        );

        self::cacheLastRefresh();

    }

    private static function cacheLastRefresh(): void
    {
        Cache::put('last_refresh', Carbon::now()->format('Y-m-d'), Carbon::now()->addDays(14));
    }

    private static function getLastRefresh(): string
    {
        return Cache::get('last_refresh');
    }

    private static function getLastCompany(): string
    {
        return Company::orderBy('official_id', 'desc')->first()->official_id;
    }

}
