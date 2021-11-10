<?php

namespace App\Services;


use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandService
{
    public static function findById(?int $brandId)
    {
        return $brandId ? BrandRepository::findById($brandId) : null;
    }
    public static function getList()
    {
        return BrandRepository::getList();
    }
    public static function store(Request $request)
    {
        $dataInsert = $request->only(['name', 'description', 'image']);
        $dataInsert['warehouse_id'] = auth()->user()->warehouse_id;
        $image_data = $request->image;
        $image_array_1 = explode(";", $image_data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '.png';
        $upload_path = storage_path('app/public/images/' . $image_name);
        file_put_contents($upload_path, $data);
        $dataInsert['image'] = $image_name;
        return BrandRepository::store($dataInsert);
    }
    public static function update(Brand $brand,Request $request)
    {
        $dataUpdate = $request->only(['name', 'description']);
        if (isset($request->extension)) {
            if ($request->image !== $brand->image) {
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
        if (!BrandRepository::update($brand, $dataUpdate)) {
            return ['error' => __('message.server_error')];
        }
        if (isset($dataUpdate['image'])) {
            \Storage::delete('/images/'.$image_data);
        }
        return [
            'success' => __('message.update_brand_successfully'),
            'view' => \View::make('admin.brands.table', [
                'brands' => BrandService::getList(),
            ])->render()
        ];

    }
}
