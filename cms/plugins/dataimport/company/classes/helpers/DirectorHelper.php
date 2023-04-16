<?php namespace Dataimport\Company\Classes\Helpers;

use Appentities\Director\Models\Director;

class DirectorHelper
{

    /**
     * @param array $director
     * @return int
     */
    public static function handleDirector(array $director): int
    {
        if ($directorId = Director::exists($director, true)) {
            return $directorId;
        }

        $directorModel = new Director();
        $directorModel->fill($director);
        $directorModel->save();

        return $directorModel->id;
    }

}
