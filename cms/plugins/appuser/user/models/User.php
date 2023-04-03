<?php namespace Appuser\User\Models;

use Model;

class User extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'appuser_user_users';

    public $rules = [];

    public $hasOne = [
        'rainlab_user' => [
            'RainLab\User\Models\User',
            'key' => 'user_id',
            'otherKey' => 'id',
        ],
    ];
}
