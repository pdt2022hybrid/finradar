<?php namespace Dataimport\Company\Classes;

use Carbon\Carbon;
use Dataimport\Company\Classes\Requests\CompanyRequest;
use Dataimport\Company\Classes\Helpers\OrsrCompany;
use Dataimport\Company\Classes\Helpers\DirectorHelper;
use Appentities\Company\Models\Company;
use Exception;
use DataImport\Statement\Classes\Services\ApiService as StatementApiService;

class ApiCompany
{

    static array $columnsInApi = [
        'official_id' => 'id',
        'ico' => 'ico',
        'dic' => 'dic',
        'legal_form' => 'pravnaForma',
        'ownership_type' => 'druhVlastnictva',
        'name' => 'nazovUJ',
        'street' => 'ulica',
        'city' => 'mesto',
        'postal_zip' => 'psc',
        'date_of_establishment' => 'datumZalozenia',
    ];

    public CompanyRequest $request;
    public $response;
    public OrsrCompany $orsrCompany;
    public Company $company;

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->request = new CompanyRequest($id);
        $this->response = $this->request->response;

        if (array_has($this->response, 'ico')) {
            $this->orsrCompany = new OrsrCompany(array_get($this->response, 'ico'));
        }
    }

    public function canCreateCompany(): bool
    {
        return true;
    }

    public function createCompany(): void
    {
        $this->company = new Company();
        $this->fillCompanyFromApi();
        $this->company->save();

        $this->fillDirectors();
    }

    public function updateCompany(): void
    {

        $this->company = Company::where('ico', $this->response['ico'])->firstOrFail();

        $this->fillCompanyFromApi();
        $this->company->save();

        $this->fillDirectors();

    }

    public function fillCompanyFromApi(): void
    {

        foreach (self::$columnsInApi as $key => $value) {
            if (array_has($this->response, $value)) {
                $this->company->$key = array_get($this->response, $value);
            }
        }

    }

    public function statements() {
        return $this->response['idUctovnychZavierok'] ?? false;
    }

    public function createStatements(): void {
        if ($this->statements()) {
            foreach ($this->statements() as $statement) {
                StatementApiService::importStatement($statement);
            }
        }
    }

    public function fillDirectors(): void
    {
        $this->orsrCompany->directors()->map(function ($director) {
            $this->attachDirector($director);
        });
    }

    private function attachDirector($director): void
    {
        $this->company->directors()->attach(
            DirectorHelper::handleDirector($director), [
                'since' => Carbon::parse(array_get($director, 'since'))->format('Y-m-d'),
            ]
        );
    }

}
