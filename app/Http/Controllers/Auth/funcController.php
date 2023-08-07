<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ProductTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use BenSampo\Enum\Rules\Enum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Psy\Readline\Hoa\Console;

class funcController extends Controller
{
    public function paid(Request $request)
    {
        $dataCart = $request->postData;
        $user = Auth::user();
        $user_cash = $user->cash;
        foreach ($dataCart as $cartPrd) {
            $objPrd = (object)($cartPrd);
            $product = Product::find($objPrd->id);
            if ($user_cash >= $product->product_price) {

                $user->cash -= $product->product_price;
                $user->save();

                $timeExpir = null;
                switch ($product->product_type) {
                    default:
                        break;
                    case (ProductTypeEnum::HOUR):
                        $timeExpir = Carbon::now()->addHour($objPrd->quantity);
                        break;
                    case (ProductTypeEnum::DAY):
                        $timeExpir = Carbon::now()->addDay($objPrd->quantity);
                        break;
                    case (ProductTypeEnum::WEEK):
                        $timeExpir = Carbon::now()->addWeek($objPrd->quantity);
                        break;
                    case (ProductTypeEnum::MONTH):
                        $timeExpir = Carbon::now()->addMonth($objPrd->quantity);
                        break;
                    case (ProductTypeEnum::YEAR):
                        $timeExpir = Carbon::now()->addYear($objPrd->quantity);
                        break;
                        $productNew = new Product();
                        $productNew->user_id = auth()->user()->id;
                        $productNew->license_key = '';
                        $productNew->license_type = $product->license_type;
                        $productNew->expir_date = $timeExpir;
                        $productNew->save();
                }
            }
        }
    }
    public function getProductType()
    {
        return ProductTypeEnum::getArrayView();
    }
}
