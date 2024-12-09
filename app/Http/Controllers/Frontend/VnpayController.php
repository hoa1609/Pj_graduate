<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\OrderRepositoryInterface as OrderRepository;
use App\Services\Interfaces\OrderServiceInterface as OrderService;
class VnpayController extends FrontendController{

    protected $orderRepository;
    protected $orderService;
    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        parent::__construct();
    }

    public function vnpay_return(Request $request)
    {
        $orderCode = $request->input('vnp_TxnRef');

        $system = $this->system;
        $seo = [
            'meta_title' => 'Thông tin thanh toán đơn hàng #'.$orderCode,
            'meta_keyword' => '',
            'meta_description' => '',
            'canonical' => write_url('cart/success', true, true),
        ];
        $configVnpay = vnpayConfig();
        $vnp_Url = $configVnpay['vnp_Url'];
        $vnp_Returnurl = $configVnpay['vnp_Returnurl'];
        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];

        $vnp_apiUrl = $configVnpay['vnp_apiUrl'];
        $apiUrl = $configVnpay['apiUrl'];
        $startTime = date("YmHis");
        $expire = date('YmHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {

                $order = $this->orderRepository->findByCondition([
                    ['code', '=', $orderCode]
                ], false, ['products']);

                $template = 'frontend.cart.component.vnpay';
                return view('frontend.cart.success', compact(
                    'seo',
                    'system',
                    'order',
                    'template',
                    'secureHash',
                    'vnp_SecureHash',
                ));
            }
            else {
                echo "GD Khong thanh cong"; die();
            }
        } else {
            echo "Chu ky khong hop le"; die();

        }
    }

    public function vnpay_ipn()
    {

        $configVnpay = vnpayConfig();
        $vnp_Url = $configVnpay['vnp_Url'];
        $vnp_Returnurl = $configVnpay['vnp_Returnurl'];
        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];
        $vnp_apiUrl = $configVnpay['vnp_apiUrl'];
        $apiUrl = $configVnpay['apiUrl'];
        $startTime = date("YmHis");
        $expire = date('YmHis', strtotime('+15 minutes', strtotime($startTime)));

        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo
        $orderId = $inputData['vnp_TxnRef'];


        try {
            if ($secureHash == $vnp_SecureHash) {
                $payload = [];
                $order = $this->orderRepository->findByCondition([
                    ['code', '=', $orderId]
                ], false, ['products']);

                if ($order != NULL) {
                    $orderAmount = $order->cart['cartTotal'] - $order->promotion['discount'];
                    if($orderAmount == $vnp_Amount)
                    {
                        if ($order->payment != NULL && $order->payment == 'unpaid') {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $payload['payment'] = 'paid';
                                $payload['confirm'] = 'confirm';
                            }else {
                                $payload['payment'] = 'failed';
                                $payload['confirm'] = 'confirm';
                            }
                            $flag = $this->orderService->updateVnpay($payload, $order);
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    }
                    else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);

    }

}
