<?php namespace Appuser\User\Http\Controllers;

use Appentities\Company\Models\Company;
use Illuminate\Routing\Controller;
use Appuser\User\Http\Resources\DashboardResource;
use Appuser\User\Classes\Services\DashboardService;

class DashboardController extends Controller
{

    public function index() {

        if (!auth()->user()->dashboard) {
            $dashboard = DashboardService::createDashboard();
        }
        else {
            $dashboard = auth()->user()->dashboard;
        }

        return DashboardResource::make($dashboard);

    }

    public function addCompany() {

        $dashboard = auth()->user()->dashboard;
        $dashboard->companies()->attach(
            Company::where('ico', input('company_ico'))->firstOrFail()
        );
        return DashboardResource::make($dashboard);

    }

    public function removeCompany() {

        $dashboard = auth()->user()->dashboard;
        $dashboard->companies()->detach(
            Company::where('ico', input('company_ico'))->firstOrFail()
        );
        return DashboardResource::make($dashboard);

    }


}
