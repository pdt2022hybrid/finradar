<?php namespace Appuser\User\Classes\Services;

use Appuser\User\models\Dashboard;

class DashboardService
{

    public static function createDashboard(): Dashboard
    {
        $dashboard = new Dashboard();
        $dashboard->user_id = auth()->user()->id;
        $dashboard->save();

        return $dashboard;
    }

}
