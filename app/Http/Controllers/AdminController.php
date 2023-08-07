<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductTypeEnum;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function products()
    {
        if (auth()->user()->user_role == 3) {
            $products = Product::get();
        } else {
            $products = Product::where('author_id', auth()->user()->id)->get();
        }
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
                'formData.license_type' => 'required|string',
                'formData.url' => 'required|string',
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
            $product->license_type = $formData->license_type;
            $product->download_url = $formData->url;
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
        try {
            $data = (object)$request->product;
            $product = Product::find($data->id);
            $product->product_name = $data->product_name;
            $product->product_price = $data->product_price;
            $product->product_type = $data->product_type;
            $product->product_info = self::convertLinkToJson($data->product_info);
            $product->product_img = self::convertLinkToJson($data->product_img);
            $product->product_vid = self::convertLinkToJson($data->product_vid);
            $product->product_description = $data->product_description;
            $product->type_id = $data->type_id;
            $product->save();
            return response()->json(['message' => 'Product save successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function productShow(Request $request)
    {
        try {
            $data = (object)$request->product;
            $product = Product::find($data->id);
            if ($product) {
                $product->is_show = !$product->is_show;
                $product->save();
            }
            return response()->json(['message' => 'Product save successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function Users()
    {
        try {
            $users = User::get();
            $role = DB::table('role')->get();
            return response()->json([
                'users' => $users,
                'role' => $role
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function UserChange(Request $request)
    {
        try {

            $userData = (object)$request->userData;

            $user = User::find($userData->id);

            if ($user) {
                $user->name = $userData->name;
                $user->email = $userData->email;
                $user->cash = $userData->cash;
                $user->user_role = $userData->user_role;
                $user->blocked = $userData->blocked;
                $user->save();
                return response()->json(['message' => 'User save successfully']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function UserDel(Request $request)
    {
        try {

            $userData = (object)$request->userData;

            $user = User::find($userData->id);

            if ($user) {
                $user->delete();
                $user->save();
                return response()->json(['message' => 'User Delete successfully']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function UserVerify(Request $request)
    {
        try {
            $userData = (object)$request->user;

            $user = User::find($userData->id);

            if ($user) {
                if ($user->email_verified_at == null) {
                    $user->email_verified_at = Carbon::now();;
                } else {
                    $user->email_verified_at = null;
                }
                $user->save();
                return response()->json(['message' => 'User Delete successfully']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
    public static function convertLinkToJson($string)
    {
        $linkArray = explode(',', $string);
        return json_encode($linkArray);
    }
}
