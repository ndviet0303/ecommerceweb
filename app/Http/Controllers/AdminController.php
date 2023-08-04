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

    public function productAdd(Request $request)
    {
        try {
            $rules = [
                'formData.name' => 'required|string|max:255',
                'formData.price' => 'required|min:0',
                'formData.type' => 'required',
                'formData.infor' => 'required|string',
                'formData.img' => 'required|string',
                'formData.vid' => 'required|string',
                'formData.description' => 'required|string',
                'formData.typeclassify' => 'required',
            ];

            $messages = [
                // Định nghĩa các thông báo lỗi tùy chỉnh nếu cần.
            ];

            $request->validate($rules, $messages);
            $formData = (object) $request->formData;
            $product = new Product();
            $product->product_name = $formData->name;
            $product->product_price = $formData->price;
            $product->product_type = $formData->type;
            $product->product_info = self::convertLinkToJson($formData->infor);
            $product->product_img = self::convertLinkToJson($formData->img);
            $product->product_vid = self::convertLinkToJson($formData->vid);
            $product->product_description = $formData->description;
            $product->type_id = $formData->typeclassify;
            $product->author_id = auth()->user()->id;
            $product->save();
            return response()->json(['message' => 'Product saved successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error saving product'], 500);
        }
    }
    public function productRemove(Request $request)
    {
        $data = (object)$request->data;
        $product = Product::find($data->id);
        if ($product) {
            if ($product->author_id == auth()->user()->id) {
                $product->delete();
                return response()->json(['message' => 'Product deleted successfully']);
            } else {
                return response()->json(['message' => 'Unauthorized. Cannot delete product']);
            }
        } else {
            return response()->json(['message' => 'Product not found']);
        }
    }
    public function productChange(Request $request)
    {
    }
    public static function convertLinkToJson($string)
    {
        $linkArray = explode(',', $string);
        return json_encode($linkArray);
    }
}
