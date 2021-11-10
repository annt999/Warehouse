<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public static function reportByProduct(Request $request)
    {
        $day = $request->day ?? date('d');
        $month = $request->month ?? date('m');
        $year = $request->year ?? date("Y");

        $productsQuery = Product::query()
            ->select(
                'products.name','products.product_code',
                \DB::raw('SUM(order_details.quantity) as quantity_sold'),
                \DB::raw('SUM(order_details.sale_price) as total_revenue'),
            )
            ->join('order_details', 'products.id', 'order_details.product_id')
            ->where('warehouse_id', auth()->user()->warehouse_id);
        if (isset($request->year)) {
            $productsQuery->whereYear('order_details.created_at', $request->year);
        }
        if (isset($request->month)) {
            $productsQuery->whereMonth('order_details.created_at', $request->month);
        }
        if (isset($request->day)) {
            $productsQuery->whereDay('order_details.created_at', $request->day);
        }
        if (count($request->all()) == 0) {
            $products = $productsQuery->whereDay('order_details.created_at', date('d'))
                ->whereMonth('order_details.created_at', date('m'))
                ->whereYear('order_details.created_at', date("Y"))
                ->get();
            return view('admin.reports.report-product', ['products' => $products]);

        }

        return view('admin.reports.report-product', ['products' => $productsQuery->get()]);
    }
}
