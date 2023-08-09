<?php

namespace App\Http\Controllers;

use App\Models\Warehouses;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = date('Y-m-d');
        $limit = $request->input('limit', 500);

        $warehouses = Warehouses::whereBetween('warehouse_date', [$dateFrom, $dateTo])->paginate($limit);

        return response()->json([
            'current_page' => $warehouses->currentPage(),
            'data' => $warehouses->items(),
            'first_page_url' => $warehouses->url(1),
            'from' => $warehouses->firstItem(),
            'last_page' => $warehouses->lastPage(),
            'last_page_url' => $warehouses->url($warehouses->lastPage()),
            'links' => [
                'url' => null,
                'label' => '&laquo; Previous',
                'active' => $warehouses->currentPage() > 1
            ],
            'next_page_url' => $warehouses->nextPageUrl(),
            'path' => $warehouses->url($warehouses->currentPage()),
            'per_page' => $warehouses->perPage(),
            'prev_page_url' => $warehouses->previousPageUrl(),
            'to' => $warehouses->lastItem(),
            'total' => $warehouses->total()
        ]);
    }
}
