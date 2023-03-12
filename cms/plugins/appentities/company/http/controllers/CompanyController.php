<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use Appentities\Financialstatement\Models\Statement;
use Appentities\Financialreport\Models\Report;
use AppEntities\Company\Http\Resources\CompanyResource;
use Carbon\Carbon;

class CompanyController extends Controller
{

    const PER_PAGE = 10;

    public static function getYear(): int
    {
        return Carbon::now()->month < 4 ? Carbon::now()->year - 2 : Carbon::now()->year - 1;
    }

    public function index() {

        $searchQuery = input('search_query');
        $revenueMin = input('revenue_min');
        $revenueMax = input('revenue_max');
        $profitMin = input('profit_min');
        $profitMax = input('profit_max');
        $order  = input('order') ?? 'revenue';
        $orderDirection = input('order_direction') ?? 'desc';

        return CompanyResource::collection(
            Company::query()
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('apidata_companies.ico', 'LIKE', '%' . $searchQuery . '%');
                })
                ->joinLatestReport(self::getYear())
                ->orderBy($order, $orderDirection)
                ->when($revenueMin, function ($query) use ($revenueMin) {
                    $query->where('revenue', '>=', $revenueMin);
                })
                ->when($revenueMax, function ($query) use ($revenueMax) {
                    $query->where('revenue', '<=', $revenueMax);
                })
                ->when($profitMin, function ($query) use ($profitMin) {
                    $query->where('profits', '>=', $profitMin);
                })
                ->when($profitMax, function ($query) use ($profitMax) {
                    $query->where('profits', '<=', $profitMax);
                })
                ->paginate(input('per_page') ?? self::PER_PAGE)
        );
    }

    public function show($ico) {
        return CompanyResource::make(
            Company::where('apidata_companies.ico', $ico)
                ->with('statements', function ($query) {
                    $query->orderBy('year', 'desc')
                    ->with('reports');
                })
                ->joinLatestReport(self::getYear())
                ->firstOrFail()
        );
    }

}
