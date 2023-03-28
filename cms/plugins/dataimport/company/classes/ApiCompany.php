<?php namespace Dataimport\Company\Classes;

use Dataimport\Company\Classes\Requests\CompanyRequest;
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
    public Company $company;

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->request = new CompanyRequest($id);
        $this->response = $this->request->response;
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
    }

    public function fillCompanyFromApi(): void
    {

        foreach (self::$columnsInApi as $key => $value) {
            if (isset($this->response[$value])) {
                $this->company->$key = $this->response[$value];
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

}
