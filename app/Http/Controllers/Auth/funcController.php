<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ProductTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BenSampo\Enum\Rules\Enum;
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
            switch ($objPrd->product_type) {
                default:
                    break;
                case (ProductTypeEnum::LIFETIME):
                    
                    break;
                case (ProductTypeEnum::HOUR):
                    break;
                case (ProductTypeEnum::DAY):
                    break;
                case (ProductTypeEnum::MONTH):
                    break;
                case (ProductTypeEnum::MONTH):
                    break;
                case (ProductTypeEnum::YEAR):
                    break;
            }
        }
    }
    public function getProductType()
    {
        return ProductTypeEnum::getArrayView();
    }
}
