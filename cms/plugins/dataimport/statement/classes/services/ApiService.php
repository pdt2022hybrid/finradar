<?php namespace DataImport\Statement\Classes\Services;

use Appentities\Company\Models\Company;
use Illuminate\Support\Facades\Http;
use Appentities\Statement\Models\Statement;
use Dataimport\Statement\Classes\ApiStatement;
use Exception;
use Log;

class ApiService
{

    public static function importStatement($id): void
    {

        if (Statement::exists($id)) {
            try {
                $statement = new ApiStatement($id); // makes request
                $statement->createReports(); // creates reports
            }
            catch (Exception $e) {
                return;
            }
            return;
        }

        try {
            $statement = new ApiStatement($id); // makes request
            $statement->createStatement(); // creates a statement
            $statement->createReports(); // creates reports
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getTraceAsString());
            return;
        }

    }

}
