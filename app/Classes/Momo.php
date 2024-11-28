<?php

namespace App\Classes;

class Momo
{

    public function __construct() {}

    public function payment($order){

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = (string)($order->cart['cartTotal'] - $order->promotion['discount']);

        $returnUrl = "http://4amstyle.com/return/momo";
        $notifyurl = "http://4amstyle.com/return/momo_ipn";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "";
        $orderid = $order->code;


        if (!empty($_POST)) {

            $orderInfo = (!empty($order->description)) ? $order->description : 'Thanh toán đơn hàng #' . $order->code . ' qua Momo';
            // $bankCode = $_POST['bankCode'];

            $requestId = time()."";
            $requestType = "payWithMoMoATM";
            $extraData = "";

            //before sign HMAC SHA256 signature
            $rawHashArr =  array(
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderid,
                'orderInfo' => $orderInfo,
                'bankCode' => $bankCode,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType
                );

                
            $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);

            $data =  array(
                'partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderid,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'bankCode' => $bankCode,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );

            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); 
            // dd($jsonResult);
            $jsonResult['url'] = $jsonResult['payUrl'];
            return $jsonResult;
        }
    }

}
