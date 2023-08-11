<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
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
        $dateTo = $request->input('dateTo');
        $limit = $request->input('limit', 500);

        $orders = Orders::whereBetween('order_date', [$dateFrom, $dateTo])->paginate($limit);

        return response()->json([
            'current_page' => $orders->currentPage(),
            'data' => $orders->items(),
            'first_page_url' => $orders->url(1),
            'from' => $orders->firstItem(),
            'last_page' => $orders->lastPage(),
            'last_page_url' => $orders->url($orders->lastPage()),
            'links' => [
                'url' => null,
                'label' => '&laquo; Previous',
                'active' => $orders->currentPage() > 1
            ],
            'next_page_url' => $orders->nextPageUrl(),
            'path' => $orders->url($orders->currentPage()),
            'per_page' => $orders->perPage(),
            'prev_page_url' => $orders->previousPageUrl(),
            'to' => $orders->lastItem(),
            'total' => $orders->total()
        ]);
    }
}
