<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use Illuminate\Http\Request;

class IncomesController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $limit = $request->input('limit', 500);

        $incomes = Incomes::whereBetween('income_date', [$dateFrom, $dateTo])->paginate($limit);

        return response()->json([
            'current_page' => $incomes->currentPage(),
            'data' => $incomes->items(),
            'first_page_url' => $incomes->url(1),
            'from' => $incomes->firstItem(),
            'last_page' => $incomes->lastPage(),
            'last_page_url' => $incomes->url($incomes->lastPage()),
            'links' => [
                'url' => null,
                'label' => '&laquo; Previous',
                'active' => $incomes->currentPage() > 1
            ],
            'next_page_url' => $incomes->nextPageUrl(),
            'path' => $incomes->url($incomes->currentPage()),
            'per_page' => $incomes->perPage(),
            'prev_page_url' => $incomes->previousPageUrl(),
            'to' => $incomes->lastItem(),
            'total' => $incomes->total()
        ]);
    }
}
