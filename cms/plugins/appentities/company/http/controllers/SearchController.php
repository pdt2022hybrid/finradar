<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use AppEntities\Company\Http\Resources\CompanyResource;

class SearchController extends Controller
{
    public function search() {
        return CompanyResource::collection(
            Company::search(input('query'))->get()
        );
    }

}
