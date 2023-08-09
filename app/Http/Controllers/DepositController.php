<?php

namespace App\Http\Controllers;

use App\Models\deposit;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function Pay(Request $request)
    {
        $data = (object)$request->Data;
        $vnp_Url = env("VNP_URL");
        $vnp_Returnurl = env("VNP_RETURNURL");
        $vnp_TmnCode = env("VNP_TMNCODE"); //Mã website tại VNPAY 
        $vnp_HashSecret = env("VNP_HASHSECRET"); //Chuỗi bí mật

        $vnp_TxnRef =  rand(1, 10000); //$_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "NapCash_" . Auth()->user()->id; //$_POST['order_desc'];
        $vnp_OrderType = 'billpayment'; //$_POST['order_type'];
        $vnp_Amount = $data->money * 100; //$_POST['amount'] * 100;
        $vnp_Locale = 'vn'; //$_POST['language'];
        $vnp_BankCode = $data->BankCode; //$_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = Carbon::now()->addMinutes(15); //$_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            $deposit = new deposit();
            $deposit->id = $vnp_TxnRef;
            $deposit->TransactionNo = 0;
            $deposit->nd = $vnp_OrderInfo;
            $deposit->Status = '';
            $deposit->Amount = $vnp_Amount;
            $deposit->save();
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function IPN(Request $request)
    {
        // Get the IPN data.
        $inputData = $request->all();
        // Check the checksum.
        $secureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= $key . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $expectedHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        if ($secureHash !== $expectedHash) {
            // Invalid checksum.
            return response()->json([
                'code' => '97',
                'message' => 'Invalid signature',
            ]);
        }

        // Get the order ID.
        $orderId = $inputData['vnp_TxnRef'];

        // Get the order.
        $order = deposit::where('id', $orderId)->first();

        // Check if the order exists.
        if (!$order) {
            // Order not found.
            return response()->json([
                'code' => '01',
                'message' => 'Order not found',
            ]);
        }
        // Check if the order amount is correct.
        if ($order->Amount / 100 !== $inputData['vnp_Amount'] / 100) {
            // Invalid amount.
            return response()->json([
                'code' => '04',
                'message' => 'Invalid amount',
            ]);
        }

        // Check if the order status is pending.
        if ($order->Status !== '') {
            // Order is not in pending status.
            return response()->json([
                'code' => '02',
                'message' => 'Order already confirmed',
            ]);
        }
        // Update the order status.
        $order->TransactionNo = $inputData["vnp_TransactionNo"];
        $order->Status = 'paid';
        $order->save();

        $user = User::find(explode("_", $order->nd)[1]);
        $user->cash += $order->Amount / 100;
        $user->Save();
        // Return a success response to VNPay.
        return redirect()->to('/');;
    }
}
