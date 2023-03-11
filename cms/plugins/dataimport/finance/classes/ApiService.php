<?php namespace Dataimport\Finance\classes;

use Appentities\Company\Models\Company;
use Appentities\Financialstatement\Models\Statement;
use Appentities\Financialreport\Models\Report;
use Illuminate\Support\Facades\Http;

class ApiService
{

    public static function createStatement($id): void
    {

        if (Statement::exists($id)) {
            return;
        }

        $response = Http::get('https://www.registeruz.sk/cruz-public/api/uctovna-zavierka', [
            'id' => $id,
        ]);

        if ($response->ok() && isset($response->json()['ico'])) {

            if (Company::exists($response->json()['ico'])) {
                $company = Company::where('ico', $response->json()['ico'])->first();
            } else {
                return;
            }


            $statement = new Statement();
            $statement->fillFromApi($response->json());
            $statement->company_id = $company->id;

            if ($statement->checkData()) {
                $statement->save();

                if (isset($response->json()['idUctovnychVykazov'])) {
                    foreach ($response->json()['idUctovnychVykazov'] as $report_id) {
                        self::createReport($report_id);
                    }
                }
            }

        }
    }

    public static function createReport($id): void
    {

        if (Report::exists($id)) {
            return;
        }

        $response = Http::get('https://www.registeruz.sk/cruz-public/api/uctovny-vykaz', [
            'id' => $id,
        ]);

        if ($response->ok()) {

            if (!Statement::exists($response->json()['idUctovnejZavierky'])) {
                return;
            } else {
                $statement = Statement::where('official_id', $response->json()['idUctovnejZavierky'])->first();
            }

            $report = new Report();
            $report->fillFromApi($response->json());
            if ($report->checkData()) {
                $report->save();
            }
        }

    }

}
