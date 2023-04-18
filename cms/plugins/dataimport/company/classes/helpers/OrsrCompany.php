<?php namespace Dataimport\Company\Classes\Helpers;

use Dataimport\Company\Classes\Requests\OrsrCompanyRequest;
use Illuminate\Support\Collection;

class OrsrCompany
{

    private $core;

    public function __construct($ico)
    {
        $this->core = new OrsrCompanyRequest($ico);
    }

    public function directors(): Collection {

        if (array_has($this->core->data, 'statutarny_organ.konateľ')) {
            return collect(
                array_get($this->core->data, 'statutarny_organ.konateľ')
            );
        }

        return collect(
            array_get($this->core->data, 'statutarny_organ.konatelia', [])
        );
    }

}
