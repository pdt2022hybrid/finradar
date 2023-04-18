<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use AppEntities\Company\Http\Resources\CompanyResource;

class SearchController extends Controller
{
    public function search()
    {

        $textResults = Company::search(input('query'))->get();
        $icoResults = Company::where('ico', 'like', '%'.input('query').'%')->get();

        $results = $textResults->merge($icoResults);

        return CompanyResource::collection($results);

    }

}
