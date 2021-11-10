<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Helpers\View;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\BrandRepository;
use App\Repositories\LocationRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function index(Request $request)
    {
        $dataSearch = $request->only(
            [
                'name', 'product_code', 'category_father_id', 'category_child_id', 'brand_id', 'quantity_max',
                'quantity_min', 'status',
            ]);
        if (($request->ajax()))
        {
            return [
                'success' => 'success',
                'view' => \View::make('admin.products.table', ['products' => ProductService::getList($dataSearch)])->render()
            ];
        }
        return view('admin.products.index', [
            'products' => ProductService::getList($dataSearch),
            'categories' => CategoryService::getCategoryFathers(),
            'brands' => BrandRepository::getListBrandOptions(),
            'locations' => LocationRepository::getListLocationOptions(),
            'productStatusOptions' => View::getProductStatus(),
            'categoryDividedByFather' => CategoryService::getCategoryDividedByFather(),
        ]);
    }

    public static function store(Request $request): array
    {
        if ($request->has('image')) {
            $imageInput = $request->get('image');
            $extension = View::getFileExtension($imageInput);
            $request->merge(['extension' => $extension]);
        }
        $productRequest = new ProductRequest();
        $request->validate($productRequest->rules(), $productRequest->messages());
        if (!ProductService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => 'Create product successfully',
            'view' => \View::make(
                'admin.products.table',
                [
                    'products' => ProductService::getList()
                ])->render()
        ];
    }

    public static function update(Request $request): array
    {
        if ($request->has('image'))
        {
            $imageInput = $request->get('image');
            $extension = View::getFileExtension($imageInput);
            $request->merge(['extension' => $extension]);
        }
        $productRequest = new ProductRequest();
        $request->validate($productRequest->rules(), $productRequest->messages());
        if (!($product = ProductService::findById($request->get('id')))) {
            return ['error' => __('message.brand_is_not_exist')];
        }
        return ProductService::update($product, $request);
    }

    public static function detail(?int $id)
    {
        return ['product' => ProductService::detail($id)];
    }

    public static function export(Request $request)
    {
        return (new ProductExport($request))->download('products.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public static function search(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Product::query()
            ->select('name', 'product_code', 'quantity_inventory', 'sale_price', 'image')
            ->where('name', 'LIKE', '%'.$query.'%')
            ->where('warehouse_id', auth()->user()->warehouse_id)
            ->orWhere('product_code', 'LIKE', '%'.$query.'%')
            ->get();
        return response()->json($filter_data);
    }
}
