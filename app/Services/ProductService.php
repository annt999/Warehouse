<?php

namespace App\Services;

use App\Helpers\Common;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    public static function getList( array $dataSearch = [])
    {
        return ProductRepository::getList($dataSearch);
    }

    public static function findById(?int $productId)
    {
        return $productId ? ProductRepository::findById($productId) : null;
    }

    public static function store(Request $request)
    {
        $dataInsert = $request->only(['name', 'description', 'image', 'location_id', 'brand_id', 'category_id',
                                         'quantity_inventory', 'sale_price', 'status',]);
        $dataInsert['warehouse_id'] = auth()->user()->warehouse_id;
        $dataInsert['product_code'] = Common::generateProductCode();
        if (!empty($dataInsert['sale_price'])) {
            $dataInsert['sale_price'] = str_replace(',', '', $dataInsert['sale_price']);
        } else {
            $dataInsert['sale_price'] = 0;
        }
        $image_data = $request->image;
        $image_array_1 = explode(";", $image_data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '.png';
        $upload_path = storage_path('app/public/images/' . $image_name);
        file_put_contents($upload_path, $data);
        $dataInsert['image'] = $image_name;
        return ProductRepository::store($dataInsert);
    }

    public static function update(Product $product,Request $request)
    {
        $dataUpdate = $request->only(['name', 'description', 'location_id', 'brand_id', 'category_id',
                                         'quantity_inventory', 'sale_price', 'status',]);
        if (isset($request->extension)) {
            if ($request->image !== $product->image) {
                $image_data = $request->image;
                $image_array_1 = explode(";", $image_data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $image_name = time() . '.png';
                $upload_path = storage_path('app/public/images/' . $image_name);
                file_put_contents($upload_path, $data);
                $dataUpdate['image'] = $image_name;
            }
        }
        if (!ProductRepository::update($product, $dataUpdate)) {
            return ['error' => __('message.server_error')];
        }
        if (isset($dataUpdate['image'])) {
            \Storage::delete('/images/'.$image_data);
        }
        return [
            'success' => __('Update product successfully'),
            'view' => \View::make('admin.products.table', [
                'products' => ProductService::getList()
            ])->render()
        ];
    }

    public static function detail(int $id)
    {
         if (is_null($product = ProductRepository::getInfoById($id))) {
             return ['error' => 'Không tồn tại'];
         }
         return $product->toArray();
    }
}
