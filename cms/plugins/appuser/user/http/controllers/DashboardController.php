<?php namespace Appuser\User\Http\Controllers;

use Appentities\Company\Models\Company;
use Illuminate\Routing\Controller;
use Appuser\User\Http\Resources\DashboardResource;
use Appuser\User\Classes\Services\DashboardService;
use October\Rain\Exception\NotFoundException;
use Validator;
use October\Rain\Exception\ValidationException;

class DashboardController extends Controller
{

    public function index(): DashboardResource
    {

        if (!auth()->user()->dashboard) {
            $dashboard = DashboardService::createDashboard();
        }
        else {
            $dashboard = auth()->user()->dashboard;
        }

        return new DashboardResource($dashboard);

    }

    /**
     * @throws NotFoundException
     */
    public function addCompany(): DashboardResource
    {

        $user = auth()->user();

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        $dashboard = $user->dashboard;

        if (!$dashboard) {
            $dashboard = DashboardService::createDashboard();
            $dashboard->user_id = auth()->user()->id;
            $dashboard->save();
        }

        $dashboard->companies()->attach(
            Company::where('ico', input('company_ico'))->firstOrFail()
        );
        return new DashboardResource($dashboard);

    }

    /**
     * @throws NotFoundException
     */
    public function removeCompany(): DashboardResource
    {

        $user = auth()->user();

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        $dashboard = $user->dashboard;

        $dashboard = auth()->user()->dashboard;

        if (!$dashboard) {
            $dashboard = DashboardService::createDashboard();
            $dashboard->user_id = auth()->user()->id;
            $dashboard->save();
        }

        $dashboard->companies()->detach(
            Company::where('ico', input('company_ico'))->firstOrFail()
        );
        return new DashboardResource($dashboard);

    }


}
