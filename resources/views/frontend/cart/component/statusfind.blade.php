@php
    $checkSuccess = 
        '<div class="text-center">
            <div class="bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
                    <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                    <circle class="success-circle-outline" cx="12" cy="12" r="11.5"/>
                    <circle class="success-circle-fill" cx="12" cy="12" r="11.5"/>
                    <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13"/>
                    </g>
                </svg>
            </div>
        </div>';
    $checkDefault = 
        '<div class="text-center">
            <div class="text-center">
                <div class="bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-default" viewBox="0 0 24 24">
                        <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                        <circle class="default-circle-outline" cx="12" cy="12" r="11.5"/>
                        <circle class="default-circle-fill" cx="12" cy="12" r="11.5"/>
                        <polyline class="default-tick" points="17,8.5 9.5,15.5 7,13"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>';
    $checkError = 
        '<div class="text-center">
            <div class="text-center">
                <div class="bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-error" viewBox="0 0 24 24">
                        <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                        <circle class="error-circle-outline" cx="12" cy="12" r="11.5"/>
                        <circle class="error-circle-fill" cx="12" cy="12" r="11.5"/>
                        <polyline class="error-tick" points="17,8.5 9.5,15.5 7,13"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>';
@endphp
<div class="row check-find-pro pb-3">
    <div class="container uk-flex uk-content-center line">
        <div class="item-check">
                {!! $checkSuccess !!}
            <div class="shiping">Đang lấy hàng</div>
        </div>
        <div class="item-check">
            @if($order->delivery == 'processing' || $order->delivery == 'success' || $order->delivery == 'error')
                {!! $checkSuccess !!}
            @else
                {!! $checkDefault !!}
            @endif
            <div class="shiping">Đang vận chuyển</div>
        </div>
        <div class="item-check">
            @if($order->delivery == 'success')
                {!! $checkSuccess !!}
                <div class="shiping">Đã nhận hàng</div>
            @elseif($order->delivery == 'error')
                {!! $checkError !!}
                <div class="shiping">Hàng bị bom</div>
            @endif
        </div>
    </div>
</div>