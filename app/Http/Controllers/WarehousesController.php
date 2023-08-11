<?php

namespace App\Http\Controllers;

use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehousesController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string',
            'dateFrom' => 'required|date_format:Y-m-d',
            'dateTo' => 'required|date_format:Y-m-d',
            'limit' => 'integer|min:1|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $key = $request->input('key');
        if ($key !== 'zmVQQaUsXscZTrRwFXluaIQX7erPkplRbmkwzdbA') {
            return response()->json(['error' => 'Invalid key'], 401);
        }

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
