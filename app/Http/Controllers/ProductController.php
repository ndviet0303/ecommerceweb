<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductTypeEnum;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showProduct()
    {

        return [
            'products' => Product::orderBy('product_bought', 'desc')
                ->where("is_show", 1)
                ->paginate(16),

            'enumExpir' => ProductTypeEnum::getArrayView()
        ];
    }

    public function showAllProduct()
    {
        $products = Product::where("is_show", 1)
            ->get();
        $typelist = DB::table('product_type')->get();
        $data = [
            'products' => $products,
            'typeList' => $typelist,
            'enumExpir' => ProductTypeEnum::getArrayView(),
        ];
        return $data;
    }
    public function productInfo($id)
    {
        $product =  Product::where('is_show', 1)
            ->where('id', $id)->first();;
        if ($product) {
            $product->product_view++;
            $product->save();
        }
        return [
            'product' => $product,
            'enumExpir' => ProductTypeEnum::getArrayView(),
        ];
    }
}
