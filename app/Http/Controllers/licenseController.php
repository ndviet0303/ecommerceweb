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

    public function Auth(Request $request)
    {
        $data = self::decryptRsa($request->data);
        $license = $data->License;
        $type = $data->Type;
        $password = $data->PassWord;

        $License_detail = License::where('license_key', $license)
            ->where('license_type', $type)
            ->firstOrFail();
        if ($License_detail->expỉy_date === null || $License_detail->expỉy_date >= Carbon::now()) {
            return self::encryptAes($password, $License_detail);
        }
    }

    private function decryptRsa($data)
    {
        $rsa = new \Crypt_RSA();
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $rsa->loadKey("-----BEGIN RSA PRIVATE KEY-----
        MIICXQIBAAKBgQDIZ2a1HhhWjKMrtr7+NRYpRcy9+IQGqxC2/Z7Yqqnbi/fbRNWX
        MRB/IdaR6k4N/cDhOb5N6a29amnhyL6BaGzvDT44UYJJZJvGI+E2Co+3a70BEgL5
        OpA3H3IyvCCtoMTvxgoziwQhKvqOlAyrg/bxzRShbu96ExK+dG8pIxYd4QIDAQAB
        AoGAAWaHlzhwnxo4gbOzPf+M+hjcx28XLRzA7yZyl70JltkxkDy46WeUX+8Sms5y
        YTKmyGwo4k6BwlMeDk/i1PCv4jCex8Z43i9cEQRT2MAAilnP+0Lh9vZ1WLtmGrgc
        G3XsIEV5uWAsrTwtm9qH8FJXHcctilE3TPCpQ1eadx61+eECQQD0F9gG+xNec5Kz
        BCqQgJDgz5l0ncYVjGhaNN+/4tL6D/a/EHBGM3wRDv8/BQCo4F5zX8ze4cVDgzKO
        NrQoUIJVAkEA0i36+swnXTaF8g6/izlvAlt6ItvItQ00FULZA5rhV5EXbvF2MKnZ
        KjePQQYSqjbtvHaCiHEczBftymFqQtKxXQJBAN2buDm+QbuC2jFFGw/OabpxQDUr
        +Ocfbq5XSrz/xePaEn8tAYH6xC0InJwugobQDXBaDbpc56d/uap759yiG3ECQQCU
        1dy6ByIE/xxBOjJn2+cBa1gFIVBy7YOpXqogxGe4w9UtSi4g7dYL8EYwjKVhBf66
        C84J4te6q2NHgk5mPZ89AkABlFN+W/uM8abmovLPNPI5jcE4UXBvgmZNFiOWOxnm
        PDcTdONS8WK7ubvmpzrysajrB57EjLRX+wQFbvICdbkh
        -----END RSA PRIVATE KEY-----        
        ");
        $post_data = base64_decode(str_replace(array('_', '-'), array('/', '+'), $data));
        return json_decode($rsa->decrypt($post_data));
    }
    private function encryptAes($password, $key_detail)
    {
        $method = 'aes-256-cbc';
        $pass_aes = substr(hash('sha256', $password, true), 0, 32);
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        return base64_encode(openssl_encrypt("true|" . $password . "|" . $key_detail->expiry_date, $method, $pass_aes, OPENSSL_RAW_DATA, $iv));
    }
}
