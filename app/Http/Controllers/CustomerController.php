<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            return [
                'success' => __('Create customer successfully'),
                'view' => \View::make('admin.customers.table',
                                      [
                                          'customers' => CustomerService::getList(),
                                          'genderOptions' => array_flip(config('common.gender'))
                                      ])->render()
            ];
        }
        return view('admin.customers.index', [
            'customers' => CustomerService::getList(),
            'genderOptions' => array_flip(config('common.gender'))
        ]);
    }

    public static function edit(string $id)
    {
        if (!($customer = CustomerService::findById($id))) {
            return ['error' => __('Customer is not exist')];
        }
        return ['customer' => $customer];
    }
    public static function store(CustomerRequest $request)
    {
        if (!CustomerService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('Create customer successfully'),
            'view' => \View::make(
                'admin.customers.table',
                [
                    'customers' => CustomerRepository::getList(),
                    'genderOptions' => array_flip(config('common.gender')),
                ]
            )->render()
        ];
    }
    public static function update(CustomerRequest $request)
    {
        $customerId = $request->get('id');
        if (!($customer = CustomerService::findById($customerId))) {
            return ['error' => __('Customer is not exist')];
        }
        return CustomerService::update($customer, $request);
    }

    public static function search(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Customer::query()
            ->select('name', 'phone_number', 'id')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orWhere('phone_number', 'LIKE', '%'.$query.'%')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->get();

        return response()->json($filter_data);
    }

    public static function transactions(Request $request)
    {
        $orderQuery = Order::query()
            ->select('customers.id as customer_id',
                \DB::raw('sum(orders.total_money) as total_transaction'),
                \DB::raw('sum(orders.debt_money) as total_debt'), 'customers.name as customer_name')
            ->join('customers', 'orders.customer_id', 'customers.id');
        if ($request->has('customer')) {
            $orderQuery = $orderQuery
                ->where('customers.name', 'like', '%' . $request->customer . '%')
                ->orWhere('customers.phone_number', 'like', '%' . $request->customer . '%');
        }
        $transactions = $orderQuery
            ->groupBy('customers.id')
            ->paginate(8);
        return view('admin.customers.transactions-list', ['transactions' => $transactions]);
    }

    public static function getTransactionsOfCustomer($id)
    {
        $sale_invoices = Order::query()
            ->select('orders.id as order_id', 'orders.debt_money', 'orders.order_code as code', 'total_money as total', 'users.username as created_by',
                'orders.created_at', DB::raw('COUNT(order_details.order_id) AS number_of_items'), 'customers.name as customer_name')
            ->leftJoin('order_details', 'order_id', 'orders.id')
            ->leftJoin('users', 'created_by', 'users.id')
            ->leftJoin('customers', 'customers.id', 'orders.customer_id')
            ->where('orders.customer_id', $id)
            ->groupBy('orders.id')
            ->paginate(5);
        return view('admin.customers.transaction-of-customer', ['sale_invoices' => $sale_invoices]);
    }
}
