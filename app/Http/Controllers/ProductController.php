<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct(){
        return Product::paginate(16);
    }

    public function productInfo($id){
        return Product::findOrFail($id);
    }
}
