<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductTypeEnum;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function products()
    {
        $products = Product::where('author_id', auth()->user()->id)->get();
         $typelist = DB::table('product_type')->get();
        return [
            'products' => $products,
            'enumExpir' => ProductTypeEnum::getArrayView(),
            'product_type' => $typelist,
        ];
    }
}
