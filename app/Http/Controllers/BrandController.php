<?php

namespace App\Http\Controllers;

use App\Helpers\View;
use App\Http\Requests\BrandRequest;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public static function index(Request $request)
    {
        if ($request->ajax()) {
            \Log::error(BrandService::getList());
            return [
                'success' => __('message.create_user_successfully'),
                'view' => \View::make('admin.brands.table',
                [
                    'brands' => BrandService::getList(),
                ])->render()
            ];
        }
        return view('admin.brands.index', [
            'brands' => Brandservice::getList(),
        ]);
    }

    public static function edit(string $id)
    {
        if (!($brand = BrandService::findById($id))) {
            return ['error' => __('message.brand_is_not_exist')];
        }
        return ['brand' => $brand];
    }
    public static function store(Request $request)
    {
        if ($request->has('image'))
        {
            $imageInput = $request->get('image');
            $extension = View::getFileExtension($imageInput);
            $request->merge(['extension' => $extension]);
        }
        $brandRequest = new BrandRequest();
        $request->validate($brandRequest->rules());
        if (!BrandService::store($request)) {
            return ['error' => __('message.server_error')];
        }
        return [
            'success' => __('message.create_brand_successfully'),
            'view' => \View::make(
                'admin.brands.table',
                [
                    'brands' => BrandRepository::getList(),
                ]
            )->render()
        ];
    }
    public static function update(Request $request)
    {
        if ($request->has('image'))
        {
            $imageInput = $request->get('image');
            $extension = View::getFileExtension($imageInput);
            $request->merge(['extension' => $extension]);
        }
        $brandId = $request->get('id');
        if (!($brand = BrandService::findById($brandId))) {
            return ['error' => __('message.brand_is_not_exist')];
        }
        return BrandService::update($brand, $request);
    }


}
