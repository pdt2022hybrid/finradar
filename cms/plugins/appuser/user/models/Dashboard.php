<?php namespace Appuser\User\models;

use October\Rain\Database\Model;
use LibUser\UserApi\Models\User;
use Appentities\Company\Models\Company;
use October\Rain\Database\Relations\BelongsTo;
use October\Rain\Database\Relations\BelongsToMany;
use October\Rain\Support\Collection;

/**
 * Dashboard Model
 *
 * @property int $id
 * @property int $user_id
 *
 * @property User $user
 * @property Collection $companies
 *
 * @method BelongsTo user()
 * @method BelongsToMany companies()
 *
 */
class Dashboard extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'appuser_dashboards';

    public $rules = [];

    public $jsonable = [
        'companies'
    ];

    public $belongsTo = [
        'user' =>
            User::class,
            'key' => 'user_id',
            'otherKey' => 'id',
    ];

    public $belongsToMany = [
        'companies' => [
            Company::class,
            'table' => 'appuser_dashboards_companies',
        ]
    ];

}
