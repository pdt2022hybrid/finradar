<?php namespace Appentities\Director\Http\controllers;

use Appentities\Director\Http\Resources\DirectorResource;
use Appentities\Director\Models\Director;

class DirectorSearchController
{

    public function search()
    {
        return DirectorResource::collection(Director::search(input('query'))->get());
    }

}
