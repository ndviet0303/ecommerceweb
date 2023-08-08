<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ProductTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\license;
use App\Models\Product;
use BenSampo\Enum\Rules\Enum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use League\CommonMark\Extension\Table\Table;
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
                }

                if ($timeExpir == null) {
                    for ($i = 0; $i < $objPrd->quantity; $i++) {
                        $license = new license();
                        $license->user_id = auth()->user()->id;
                        $license->license_key = '';
                        $license->license_type = $product->license_type;
                        $license->expiry_date = $timeExpir;
                        $license->save();

                        $product->product_bought++;
                        $product->save();
                    }
                    return response()->json(['message' => 'Success']);
                } else {
                    $license = new license();
                    $license->user_id = auth()->user()->id;
                    $license->license_key = '';
                    $license->license_type = $product->license_type;
                    $license->expiry_date = $timeExpir;
                    $license->save();

                    $product->product_bought++;
                    $product->save();
                    return response()->json(['message' => 'Success']);
                }
            }
        }
    }
    public function getProductType()
    {
        return ProductTypeEnum::getArrayView();
    }
}
