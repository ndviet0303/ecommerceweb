<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showProduct()
    {
        return Product::orderBy('product_bought', 'desc')
            ->where("is_show", 1)
            ->paginate(16);
    }

    public function showAllProduct()
    {
        $products = Product::where("is_show", 1)
            ->get();
        $typelist = DB::table('type_product')->get();
        $data = [
            'products' => $products,
            'typeList' => $typelist,
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
        return $product;
    }
}
