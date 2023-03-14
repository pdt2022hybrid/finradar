<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use AppEntities\Company\Http\Resources\CompanyResource;

class SearchController extends Controller
{
    public function search(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $searchResults = Company::search(request('query'))->get();
        $queryResult =Company::where('ico', 'like', '%'.request('query').'%')->get();

        $results = $searchResults->merge($queryResult);

        return CompanyResource::collection($results);

    }

}
