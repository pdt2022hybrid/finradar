<?php namespace Appuser\User\Classes\Extend;

use LibUser\UserApi\Models\User;

class UserExtend
{

    public static function addRelations(): void
    {

        self::addDashboardRelation();

    }

    private static function addDashboardRelation(): void
    {
        User::extend(function (User $user) {

            $user->hasOne['dashboard'] = [
                'Appuser\User\Models\Dashboard',
                'key' => 'user_id',
                'otherKey' => 'id',
            ];

        });
    }

}
