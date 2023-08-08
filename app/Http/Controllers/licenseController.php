<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\license;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Enums\ProductTypeEnum;

class licenseController extends Controller
{
    public function licenseShow()
    {
        $license = license::where('user_id', auth()->user()->id)->get();
        return $license;
    }

    public function licenseChange(Request $request)
    {
        try {
            $licenseData = (object)$request->license;

            $license = license::where('user_id', auth()->user()->id)
                ->where('id', $licenseData->id)->first();
            if ($license) {
                $license->license_key = $licenseData->license_key;
                $license->save();
            }
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Fail ' . $e]);
        }
    }

    public function licenseExtend(Request $request)
    {
        try {
            $data = (object)$request->data;

            $licenseData = (object)$data->license;
            $quan = $data->quan;
            if ($quan > 0) {
                $license = license::where('user_id', auth()->user()->id)
                    ->where('id', $licenseData->id)->first();
                if ($license) {
                    $timeExpir = null;
                    $user = Auth()->user();
                    $product = Product::where('license_type', $license->license_type)->first();
                    $total_cash = $product->product_price * $quan;

                    if ($user->cash >= $total_cash) {
                        switch ($product->product_type) {

                            default:
                                break;
                            case (ProductTypeEnum::HOUR):
                                if (Carbon::parse($license->expiry_date) >= Carbon::now()) {
                                    $timeExpir = Carbon::parse($license->expiry_date)->addHour($quan);
                                } else {
                                    $timeExpir = Carbon::now()->addHour($quan);
                                }
                                break;
                            case (ProductTypeEnum::DAY):
                                if (Carbon::parse($license->expiry_date) >= Carbon::now()) {
                                    $timeExpir = Carbon::parse($license->expiry_date)->addDay($quan);
                                } else {
                                    $timeExpir = Carbon::now()->addDay($quan);
                                }
                                break;
                            case (ProductTypeEnum::WEEK):
                                if (Carbon::parse($license->expiry_date) >= Carbon::now()) {
                                    $timeExpir = Carbon::parse($license->expiry_date)->addWeek($quan);
                                } else {
                                    $timeExpir = Carbon::now()->addWeek($quan);
                                }
                                break;
                            case (ProductTypeEnum::MONTH):
                                if (Carbon::parse($license->expiry_date) >= Carbon::now()) {
                                    $timeExpir = Carbon::parse($license->expiry_date)->addMonth($quan);
                                } else {
                                    $timeExpir = Carbon::now()->addMonth($quan);
                                }
                                break;
                            case (ProductTypeEnum::YEAR):
                                if (Carbon::parse($license->expiry_date) >= Carbon::now()) {
                                    $timeExpir = Carbon::parse($license->expiry_date)->addYear($quan);
                                } else {
                                    $timeExpir = Carbon::now()->addYear($quan);
                                }
                                break;
                        }
                        if ($timeExpir !== null) {
                            $license->expiry_date =  $timeExpir;
                            $license->save();
                        }
                    }
                }
                return response()->json(['message' => 'Success']);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Fail ' . $e]);
        }
    }
}
