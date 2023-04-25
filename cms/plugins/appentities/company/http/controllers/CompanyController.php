<?php namespace AppEntities\Company\Http\Controllers;

use Illuminate\Routing\Controller;
use Appentities\Company\Models\Company;
use AppEntities\Company\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{

    const PER_PAGE = 10;

    public function index(): AnonymousResourceCollection
    {

        $searchQuery = input('search_query');
        $revenueMin = input('revenue_min');
        $revenueMax = input('revenue_max');
        $profitsMin = input('profits_min');
        $profitsMax = input('profits_max');
        $order  = input('order', 'revenue');
        $orderDirection = input('order_direction', 'desc');
        $perPage = input('per_page', self::PER_PAGE);

        return CompanyResource::collection(
            Company::query()
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('apidata_companies.ico', 'LIKE', '%' . $searchQuery . '%');
                })
                ->joinLatestReport()
                ->orderBy($order, $orderDirection)
                ->when($revenueMin, function ($query) use ($revenueMin) {
                    $query->where('revenue', '>=', $revenueMin);
                })
                ->when($revenueMax, function ($query) use ($revenueMax) {
                    $query->where('revenue', '<=', $revenueMax);
                })
                ->when($profitsMin, function ($query) use ($profitsMin) {
                    $query->where('profits', '>=', $profitsMin);
                })
                ->when($profitsMax, function ($query) use ($profitsMax) {
                    $query->where('profits', '<=', $profitsMax);
                })
                ->paginate(input('per_page') ?? $perPage)
        );
    }

    public function show($ico): CompanyResource
    {
        return new CompanyResource(
            Company::where('apidata_companies.ico', $ico)
                ->with('statements', function ($query) {
                    $query->orderBy('year', 'desc') >with('reports');
                })
                ->with('reports')
                ->with('directors')
                ->firstOrFail()
        );
    }

}
