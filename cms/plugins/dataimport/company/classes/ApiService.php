<?php namespace DataImport\Company\Classes;

use Appentities\Company\Models\Company;
use Illuminate\Support\Facades\Http;

class ApiService
{

    public static function hardRefresh()
    {
        self::refresh();
        return 'done';
    }

    public static function gracefulRefresh()
    {
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
            $response->ok()
            && $response->json()['existujeDalsieId']
        );

    }


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
        }

    }
}
