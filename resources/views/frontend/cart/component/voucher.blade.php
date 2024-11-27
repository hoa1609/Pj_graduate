<div class="voucher-container uk-hidden">
    <div class="panel-voucher uk-flex">
        @for($i = 0 ; $i <3; $i++)
        <div class="voucher-item">
            <div class="voucher-left"></div>
            <div class="voucher-right">
                <div class="voucher-title">PH98989</div>
                <div class="voucher-description">
                    <p>khuyến mãi ngày tình yêu</p>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="voucher-form">
        <input type="text" placeholder="chọn mã giảm giá" name="voucher" value="" >
        <a href="" class="apply-voucher">Áp dụng</a>
    </div>
</div>