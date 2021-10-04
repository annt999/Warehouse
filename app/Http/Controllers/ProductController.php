<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function index(Request $request)
    {
        if (($request->ajax()))
        {

        }
        return view('admin.products.index', [
            'products' => ProductService::getList(),
        ]);
    }
}
