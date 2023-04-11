<?php namespace DataImport\Company\Classes\services;

use Appentities\Company\Models\Company;
use Illuminate\Support\Facades\Http;
use Dataimport\Company\Classes\ApiCompany;
use Exception;

/**
 * Class ApiService
 *
 */
class ApiService
{

    /**
     * @param $id * The id(in govt system) of the company to create
     * @return void
     */
    public static function importCompany($id): void
    {
        if (Company::exists($id)) {
            try {
                $company = new ApiCompany($id);
                $company->createStatements();
            }
            catch (Exception $e) {
                return;
            }
            return;
        }

        try {
            $company = new ApiCompany($id);
            $company->createCompany();
            $company->createStatements();
        } catch (Exception $e) {
            return;
        }

    }
}
