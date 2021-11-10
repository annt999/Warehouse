<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class HomeController extends Controller
{
    public static function getHomeGuest()
    {
        return view('admin.home.home-guest');
    }
    public static function getHome()
    {
        $todaySalesResult = [];
        $todaySalesResult['new_customers'] = Customer::query()
            ->whereBetween('created_at', [Carbon::today()->toDateTimeString(), Carbon::today()->endOfDay()->toDateTimeString()])
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->count();
        $todayOrder = Order::query()
            ->select(\DB::raw('COUNT(*) as total_orders'), \DB::raw('SUM(total_money) as total_money'), \DB::raw('SUM(debt_money) as total_debt'))
            ->whereBetween('created_at', [Carbon::today()->toDateTimeString(), Carbon::today()->endOfDay()->toDateTimeString()])
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->first();
        $todaySalesResult['total_orders'] = $todayOrder->total_orders;
        $todaySalesResult['total_money'] = $todayOrder->total_money;
        $todaySalesResult['total_debt'] = $todayOrder->total_debt;
        $todaySalesResult['total_actual_revenue'] = $todayOrder->total_money - $todayOrder->total_debt;

        $monthOrdersData = Order::query()
            ->select(\DB::raw('created_at'), \DB::raw('SUM(total_money) as total_money'))
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->groupBy('created_at')
            ->get();
        $monthOrders = [];
        $daysOfMonth = date('t');
        for ($i = 1; $i<= $daysOfMonth; $i++)
        {
            $monthOrders[$i] = 0;
        }
        foreach ($monthOrdersData as $monthOrder) {
            $monthOrders[(int)$monthOrder->created_at->format('d')] = $monthOrder->total_money;
        }

        $topSaleProductsData = Product::query()
            ->select('products.id', 'products.name', \DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('order_details', 'products.id', 'order_details.product_id')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'DESC')
            ->limit(10)->get();
        $quantityBestSaleProduct = [];
        $bestSaleProductNames = [];
        foreach ($topSaleProductsData as $product) {
            $quantityBestSaleProduct[] = $product->total_quantity;
            $bestSaleProductNames[] = $product->name;
        }
        $lengthQuantityArray = count($quantityBestSaleProduct);
        $lengthNameArray = count($bestSaleProductNames);
        for ($i = 0; $i<= 9; $i++) {
            if (($i + 1) > $lengthNameArray) {
                $bestSaleProductNames[$i] = 0;
            }
            if (($i + 1) > $lengthQuantityArray) {
                $quantityBestSaleProduct[$i] = 0;
            }
        }
        return view('admin.home.index',
            [
                'todaySalesResult' => $todaySalesResult,
                'monthOrders' => array_values($monthOrders),
                'bestSaleProductNames' => array_values($bestSaleProductNames),
                'quantityBestSaleProduct' => array_values($quantityBestSaleProduct)
            ]);
    }
}
