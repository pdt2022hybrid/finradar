<?php namespace Appentities\Statement\Models;

use Model;

class Statement extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'apidata_statements';

    public $rules = [];

    public $belongsTo = [
        'company' => [
            'Appentities\Company\Models\Company',
            'key' => 'ico',
            'otherKey' => 'ico',
        ],
    ];

    public $hasMany = [
        'reports' => [
            'Appentities\Report\Models\Report',
            'key' => 'statement_id',
            'otherKey' => 'official_id',
        ],
    ];
    public static function exists($id) {
        return self::where('official_id', $id)->exists();
    }
}

