<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use Appentities\Financialstatement\Models\Statement;

class CompanyController extends Controller
{

    const PER_PAGE = 10;

    public function index() {
        return
            Company::query()
                ->with('statements')
                ->orderBy(input('order') ?? 'ico', input('order_dir') ?? 'asc')
                ->paginate(input('per_page') ?? self::PER_PAGE);
    }

    public function show($id) {
        return
            Statement::where('ico', Company::query()->findOrFail(272)->ico)->get();
    }

}
