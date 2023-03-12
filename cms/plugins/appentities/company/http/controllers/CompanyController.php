<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use Appentities\Financialstatement\Models\Statement;
use AppEntities\Company\Http\Resources\CompanyResource;
use Carbon\Carbon;

class CompanyController extends Controller
{

    const PER_PAGE = 10;

    public function index() {

        $searchQuery = input('search_query');
        $revenueMin = input('revenue_min');
        $revenueMax = input('revenue_max');
        $profitMin = input('profit_min');
        $profitMax = input('profit_max');

        $year = Carbon::now()->month < 4 ? Carbon::now()->year : Carbon::now()->year - 1;

        return CompanyResource::collection(
            Company::query()
                ->orderBy(input('order') ?? 'ico', input('order_dir') ?? 'asc')
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('ico', 'LIKE', '%' . $searchQuery . '%');
                })
                ->when($revenueMin, function ($query) use ($revenueMin, $year) {
                    $query->whereHas('statements', function ($query) use ($revenueMin, $year) {
                        $query->whereHas('reports', function ($query) use ($revenueMin, $year) {
                            $query->where('year', $year)->where('revenue', '>=', $revenueMin);
                        });
                    });
                })
                ->when($revenueMax, function ($query) use ($revenueMax, $year) {
                    $query->whereHas('statements', function ($query) use ($revenueMax, $year) {
                        $query->whereHas('reports', function ($query) use ($revenueMax, $year) {
                            $query->where('year', $year)->where('revenue', '<=', $revenueMax);
                        });
                    });
                })
                ->when($profitMin, function ($query) use ($profitMin, $year) {
                    $query->whereHas('statements', function ($query) use ($profitMin, $year) {
                        $query->whereHas('reports', function ($query) use ($profitMin, $year) {
                            $query->where('year', $year)->where('profits', '>=', $profitMin);
                        });
                    });
                })
                ->when($profitMax, function ($query) use ($profitMax, $year) {
                    $query->whereHas('statements', function ($query) use ($profitMax, $year) {
                        $query->whereHas('reports', function ($query) use ($profitMax, $year) {
                            $query->where('year', $year)->where('profits', '<=', $profitMax);
                        });
                    });
                })
                ->paginate(input('per_page') ?? self::PER_PAGE)
        );
    }

    public function show($ico) {
        return CompanyResource::make(
            Company::where('ico', $ico)
                ->with('statements', function ($query) {
                    $query->orderBy('year', 'desc')
                    ->with('reports');
                })
                ->firstOrFail()
        );
    }

}
