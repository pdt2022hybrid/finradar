<?php namespace DataImport\Company\Classes;

use Appentities\Company\Models\Company;
use Illuminate\Support\Facades\Http;
use Dataimport\Finance\classes\ApiService as FinanceApiService;

/**
 * Class ApiService
 *
 */
class ApiService
{
    public static function hardRefresh()
    {
        set_time_limit(0);
        self::refresh();
        return 'done';
    }

    public static function gracefulRefresh()
    {
        set_time_limit(0);
        self::refresh(Company::orderBy('official_id', 'desc')->first()->official_id);
        return 'done';
    }

    public static function refresh($last_id = 0): void
    {

        do {
            $response = Http::get('https://www.registeruz.sk/cruz-public/api/uctovne-jednotky', [
                'zmenene-od' => '2000-01-01',
                'pokracovat-za-id' => $last_id,
                'max-zaznamov' => 10000,
            ]);


            if ($response->status() === 200) {

                foreach ($response->json()['id'] as $company_id) {
                    self::createCompany($company_id);
                }

                $last_id = collect($response->json()['id'])->last();
            }

        } while (
            $response->ok() && $response->json()['existujeDalsieId']
        );

    }

    /**
     * @param $id * The id(in govt system) of the company to create
     * @return void
     */
    public static function createCompany($id): void
    {
        if (Company::exists($id)) {
            return;
        }

        $response = Http::get('https://www.registeruz.sk/cruz-public/api/uctovna-jednotka', [
            'id' => $id,
        ]);

        if ($response->ok()) {
            if (isset($response->json()['stav'])) {
                if ($response->json()['stav'] === 'ZMAZANÉ') {
                    return;
                }
            }
            $company = new Company();
            $company->fillFromApi($response->json());
            $company->save();

            if (isset($response->json()['idUctovnychZavierok'])) {
                foreach ($response->json()['idUctovnychZavierok'] as $statement_id) {
                    FinanceApiService::createStatement($statement_id);
                }
            }
        }

    }
}
