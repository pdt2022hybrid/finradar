<?php namespace Appuser\User\Classes\Extend;

use RainLab\User\Models\User as RainLabUser;
use Appuser\User\Models\User as AppUser;

class UserExtend
{

    public static function addRelation(): void
    {

        RainLabUser::extend(function (RainLabUser $user) {

            $user->belongsTo['app_user'] = [
                AppUser::class,
                'key' => 'user_id',
                'otherKey' => 'id',
            ];

        });

    }

}
