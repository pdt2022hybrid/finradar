<?php namespace Dataimport\Report\classes\services;

use Appentities\Company\Models\Company;
use Appentities\Report\Models\Report;
use Dataimport\Report\classes\ApiReport;
use Exception;
use Log;

class ApiService
{

    public static function importReport($id): void
    {

        if (Report::exists($id)) {
            return;
        }

        try {
            $report = new ApiReport($id); // makes request
            $report->createReport(); // creates report
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getTraceAsString());
            return;
        }

    }

}
