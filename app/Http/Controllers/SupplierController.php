<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            return [
                'success' => __('success'),
                'view' => \View::make('admin.suppliers.table',
                    [
                        'suppliers' => SupplierService::getList(),
                    ])->render()
            ];
        }
        return view('admin.suppliers.index', [
            'suppliers' => Supplierservice::getList(),
        ]);
    }

    public static function edit(string $id)
    {
        if (!($supplier = SupplierService::findById($id))) {
            return ['error' => 'Supplier does not exist'];
        }
        return ['supplier' => $supplier];
    }
    public static function store(SupplierRequest $request)
    {
        if (!SupplierService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => 'Create supplier successfully',
            'view' => \View::make(
                'admin.suppliers.table',
                [
                    'suppliers' => SupplierRepository::getList(),
                ]
            )->render()
        ];
    }
    public static function update(SupplierRequest $request)
    {
        $supplierId = $request->get('id');
        if (!($supplier = SupplierService::findById($supplierId))) {
            return ['error' => 'Supplier does not exist'];
        }
        return SupplierService::update($supplier, $request);
    }

    public static function getList(Request $request)
    {
        $data = [];
        $search = '';
        if($request->has('query')){
            $search = $request->query;
        }
        $data = Supplier::select("id","name")
            ->where('name','LIKE',"%$search%")
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->get();
        return response()->json($data);
    }
}
