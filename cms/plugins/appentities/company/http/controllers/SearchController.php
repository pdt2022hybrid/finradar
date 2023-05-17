<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use AppEntities\Company\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;

class SearchController extends Controller
{
    public function search()
    {
        $validator = Validator::make(request()->all(), [
            'query' => 'required|min:3',
        ]);


        if ($validator->fails()) {
            throw new ValidationException($validator);
        }


        $textResults = Company::search(input('query'))->get();
        $icoResults = Company::where('ico', 'like', '%'.input('query').'%')->get();

        $results = $textResults->merge($icoResults);

        return CompanyResource::collection($results);

    }

}
