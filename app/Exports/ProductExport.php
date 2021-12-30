<?php

namespace App\Exports;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductExport implements
    FromQuery,
    WithMapping,
    WithHeadings,
    ShouldAutoSize,
    ShouldQueue
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function map($product): array
    {
        $status = array_flip(config('common.product_status'));
        return [
            $product->product_code,
            $product->name,
            $product->image,
            $product->quantity,
            $product->purchase_price,
            $product->sale_price,
            $product->category,
            $product->brand,
            $product->location,
            $status[$product->status],
            $product->description,
        ];
    }

    public function headings(): array
    {
        return [
            'Product code',
            'Name',
            'Image',
            'Quantity',
            'Purchase price',
            'Sale price',
            'Category',
            'Brand',
            'Location',
            'Status',
            'Description',
        ];
    }

    public function query()
    {
        $dataSearch = $this->request->only(
            [
                'name', 'product_code', 'category_father_id', 'category_child_id', 'brand_id', 'quantity_max',
                'quantity_min', 'status', 'supplier_id'
            ]);
        $query = Product::query();
        $query->select('products.*', 'categories.name as category', 'brands.image as brand_image',
                       'brands.name as brand', 'locations.name as location', 'products.warehouse_id')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->leftJoin('brands', 'brands.id', 'products.brand_id')
            ->leftJoin('locations', 'locations.id', 'products.location_id');

        if (isset($dataSearch['product_code'])) {
            $query->where('products.product_code', $dataSearch['product_code']);
        }

        if (isset($dataSearch['name'])) {
            $query->where('products.name','like', '%'. $dataSearch['name'] .'%');
        }

        if (isset($dataSearch['brand_id'])) {
            $query->where('brands.id', $dataSearch['brand_id']);
        }

        if (isset($dataSearch['category_child_id'])) {
            $query->where('categories.id', $dataSearch['category_child_id']);
        }

        if (isset($dataSearch['status'])) {
            $query->where('products.status', $dataSearch['status']);
        }

        if (isset($dataSearch['quantity_min'])) {
            $query->where('products.quantity', '>=', $dataSearch['quantity_min']);
        }

        if (isset($dataSearch['quantity_max'])) {
            $query->where('products.quantity', '<=', $dataSearch['quantity_max']);
        }

        $query->where('warehouse_id', auth()->user()->warehouse_id);
        $query->orderBy('created_at');
        return $query;
    }
}
