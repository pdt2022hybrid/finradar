<?php namespace Appentities\Director\Http\controllers;

use Appentities\Director\Http\Resources\DirectorResource;
use Appentities\Director\Models\Director;

class DirectorController
{

    public function show($id): DirectorResource
    {
        return DirectorResource::make(Director::where('id', $id)->with('companies')->firstOrFail());
    }

}
