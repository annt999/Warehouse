<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Models\ImportDetail;
use App\Models\ImportHistory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function getById($id)
    {
        if (!($order = Order::query()->find($id))) {
            return ['error' => __('Order are not exist')];
        }
        return ['order' => $order];    }

    // logic to import
    public function getImportHistory(Request $request)
    {
        if ($request->ajax()) {
            $import_invoices = ImportHistory::query()
                ->select('import_history.id as code', 'total', 'users.username as created_by',
                    'import_history.created_at', DB::raw('COUNT(import_details.import_history_id) AS number_of_items'))
                ->leftJoin('import_details', 'import_history_id', 'import_history.id')
                ->leftJoin('users', 'created_by', 'users.id')
                ->where('import_history.warehouse_id', auth()->user()->warehouse_id)
                ->groupBy('import_history.id')
                ->paginate(5);
            return \View::make('admin.orders.import-history-table', ['import_invoices' => $import_invoices])->render();
        }
        $import_invoices = ImportHistory::query()
            ->select('import_history.id as code', 'total', 'users.username as created_by',
                'import_history.created_at', DB::raw('COUNT(import_details.import_history_id) AS number_of_items'))
            ->leftJoin('import_details', 'import_history_id', 'import_history.id')
            ->leftJoin('users', 'created_by', 'users.id')
            ->where('import_history.warehouse_id', auth()->user()->warehouse_id)
            ->groupBy('import_history.id')
            ->paginate(5);
        return view('admin.orders.import-history', ['import_invoices' => $import_invoices]);
    }

    public function getCreateImportPage()
    {
        return view('admin.orders.import-create');
    }

    public static function import(Request $request)
    {
        $import_history = ImportHistory::query()->create([
            'created_by' => auth()->user()->id,
            'total' => $request->total,
            'supplier_id' => $request->supplier_id,
            'warehouse_id' => auth()->user()->warehouse_id,
        ]);

        $products = json_decode($request->products);
        foreach($products as $product) {
            $productUpdate = Product::query()->where('product_code', $product->product_code)->first();
            $productUpdate->update([
                'sale_price' => $product->sale_price,
                'quantity_inventory' => $productUpdate->quantity_inventory + $product->quantity,
                                   ]);
            ImportDetail::query()->create([
                'import_history_id' => $import_history->id,
                'product_id' => $productUpdate->id,
                'quantity' => $product->quantity,
                'purchase_price' => $product->purchase_price,
                'sale_price' => $product->sale_price,
            ]);
        }

        return [
            'data' => $products
        ];
    }

    public static function detail(int $id, Request $request)
    {
        if ($request->ajax()) {
            $importDetail = ImportDetail::query()
                ->select('import_details.*', 'products.product_code')
                ->leftJoin('products', 'products.id', 'import_details.product_id')
                ->where('import_history_id', $id)->paginate(5);
            return \View::make('admin.orders.import-detail-table', ['import_details' =>  $importDetail, 'import_history_code' => $id])->render();
        }
        $importDetails = ImportDetail::query()
            ->select('import_details.*', 'products.product_code')
            ->leftJoin('products', 'products.id', 'import_details.product_id')
            ->where('import_history_id', $id)->paginate(5);
        return view('admin.orders.import-detail', ['import_details' =>  $importDetails, 'import_history_code' => $id]);
    }

    // logic to sale
    public function getSaleHistory(Request $request)
    {
        if ($request->ajax()) {
            $sale_invoices = Order::query()
                ->select('orders.id as order_id', 'orders.debt_money', 'orders.order_code as code', 'total_money as total', 'users.username as created_by',
                    'orders.created_at', DB::raw('COUNT(order_details.order_id) AS number_of_items'), 'customers.name as customer_name')
                ->leftJoin('order_details', 'order_id', 'orders.id')
                ->leftJoin('users', 'created_by', 'users.id')
                ->leftJoin('customers', 'customers.id', 'orders.customer_id')
                ->where('orders.warehouse_id', auth()->user()->warehouse_id)
                ->groupBy('orders.id')
                ->paginate(5);
            return \View::make('admin.orders.sale-history-table', ['sale_invoices' => $sale_invoices])->render();
        }
        $sale_invoices = Order::query()
            ->select('orders.id as order_id', 'orders.debt_money', 'orders.order_code as code', 'total_money as total', 'users.username as created_by',
                'orders.created_at', DB::raw('COUNT(order_details.order_id) AS number_of_items'), 'customers.name as customer_name')
            ->leftJoin('order_details', 'order_id', 'orders.id')
            ->leftJoin('users', 'created_by', 'users.id')
            ->leftJoin('customers', 'customers.id', 'orders.customer_id')
            ->where('orders.warehouse_id', auth()->user()->warehouse_id)
            ->groupBy('orders.id')
            ->paginate(5);
        return view('admin.orders.sale-history', ['sale_invoices' => $sale_invoices]);
    }

    public function getCreateSalePage()
    {
        return view('admin.orders.sale-create');
    }

    public static function sale(Request $request)
    {
        DB::beginTransaction();
        try {
            $warehouseId = auth()->user()->warehouse_id;
            $moneyPaidByCustomer = $request->customer_pay < $request->total ? $request->customer_pay : $request->total;
            $order = Order::query()->create([
                'order_code' => Common::generateOrderCode(),
                'total_money' => $request->total,
                'created_by' => auth()->user()->id,
                'customer_id' => $request->customer_id,
                'warehouse_id' => $warehouseId,
                'debt_money' => $request->total - $moneyPaidByCustomer,
            ]);

            $payment = Payment::query()->create([
                'order_id' => $order->id,
                'payment_money' => $moneyPaidByCustomer,
                'created_by' => auth()->user()->id,
                'warehouse_id' => auth()->user()->warehouse_id,
            ]);

            $products = json_decode($request->products);
            foreach($products as $product) {
                $productUpdate = Product::query()->where('product_code', $product->product_code)->first();
                $productUpdate->update([
                    'quantity_inventory' => $productUpdate->quantity_inventory - $product->quantity,
                ]);
                OrderDetail::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $productUpdate->id,
                    'quantity' => $product->quantity,
                    'sale_price' => $product->sale_price,
                ]);
                DB::commit();
            }
            return [
                'data' => $products
            ];
        } catch (\Exception $exception) {
            \Log::error($exception);
            DB::rollBack();
            return ['error' => __('message.server_error')];
        }
    }

    public static function saleDetail(int $id, Request $request)
    {
        $saleDetails = OrderDetail::query()
            ->select('order_details.*', 'products.product_code', 'products.image')
            ->leftJoin('products', 'products.id', 'order_details.product_id')
            ->where('order_id', $id)->get();
        $paymentDetails = Payment::query()
            ->select('payments.*', 'users.username as created_by')
            ->leftJoin('users', 'users.id', 'payments.created_by')
            ->where('order_id', $id)->get();
        return view('admin.orders.sale-detail',
            [
                'sale_details' =>  $saleDetails,
                'payment_details' => $paymentDetails,
                'order_code' => Order::query()->find($id)->order_code,
            ]);
    }

    public static function storePayment(Request $request)
    {
        $orderUpdate = Order::query()->find($request->order_id);
        $totalMoney = $orderUpdate->total_money;
        $request->validate(['payment_money' => 'required|min:1|max:' . ($totalMoney - $request->payment_money)]);
        try {
            Payment::query()->create([
                'order_id' => $request->order_id,
                'payment_money' => $request->payment_money,
                'created_by' => auth()->user()->id,
            ]);

            $debt_money = $orderUpdate->debt_money - $request->payment_money;
            $orderUpdate->update([
                'debt_money' => $debt_money > 0 ? $debt_money : 0,
            ]);
            $sale_invoices = Order::query()
                ->select('orders.id as order_id', 'orders.debt_money', 'orders.order_code as code', 'total_money as total', 'users.username as created_by',
                    'orders.created_at', DB::raw('COUNT(order_details.order_id) AS number_of_items'), 'customers.name as customer_name')
                ->leftJoin('order_details', 'order_id', 'orders.id')
                ->leftJoin('users', 'created_by', 'users.id')
                ->leftJoin('customers', 'customers.id', 'orders.customer_id')
                ->where('orders.warehouse_id', auth()->user()->warehouse_id)
                ->groupBy('orders.id')
                ->paginate(5);

            return ['view' => \View::make('admin.orders.sale-history-table', ['sale_invoices' => $sale_invoices])->render()];
        } catch (\Exception $exception) {
            \Log::error($exception);
            return [
                'error' => 'An error has occurred',
            ];
        }
    }
}
