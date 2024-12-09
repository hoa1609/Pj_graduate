<div class="table-reposive">
    <div class="text-bold">Mã đơn hàng:
        <span class="text-normal">{{ $_GET['vnp_TxnRef'] }}</span>
    </div>
    <div class="text-bold">Số tiền:
        <span class="text-normal">{{ $_GET['vnp_Amount'] }}</span>
    </div>
    <div class="text-bold">Nội dung thanh toán:
        <span class="text-normal">{{ $_GET['vnp_OrderInfo'] }}</span>
    </div>
    <div class="text-bold">Mã phản hồi:
        <span class="text-normal">{{ $_GET['vnp_ResponseCode'] }}</span>
    </div>
    <div class="text-bold">Mã GD tại VNPAY:
        <span class="text-normal">{{ $_GET['vnp_TransactionNo'] }}</span>
    </div>
    <div class="text-bold">Mã ngân hàng:
        <span class="text-normal">{{ $_GET['vnp_BankCode'] }}</span>
    </div>
    <div class="text-bold">Thời gian thanh toán:
        <span class="text-normal">{{ $_GET['vnp_PayDate'] }}</span>
    </div>
    <div class="form-group">
        <label class="text-bold">Kết quả: </label>
        <label>
            @if ($secureHash == $vnp_SecureHash)
                @if ($_GET['vnp_ResponseCode'] == '00')
                    <span style="color: blue">Giao dịch qua cổng VNPAY thành công</span>
                @else
                    <span style="color: red">Giao dịch qua cổng VNPAY thất bại</span>
                @endif
            @else
                <span style="color: red">Chữ ký không hợp lệ</span>
            @endif
        </label>
    </div>
</div>
