
<div class="card-body pt-0">
    <div class="mb-2"><i class="text-danger">*Tổng cuối là tổng chưa bao gồm giảm giá</i></div>
    <div class="table-responsive mb-3">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                </th>
                <th>Mã</th>
                <th>Ngày tạo</th>
                <th>Khách hàng</th>
                <th>Giảm giá</th>
                <th>Phí ship</th>
                <th>Tổng cuối</th>
                <th>Trạng thái</th>
                <th>Thanh toán</th>
                <th>Giao hàng</th>
                <th>Hình thức</th>
            </tr>
            </thead>
            <tbody>
                @if (isset($orders) && is_object($orders))
                    @foreach ($orders as $order)
                        <tr>
                            <th style="width: 16px;">
                                <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $order-> id }}">
                            </th>
                            <td>
                                <a href="{{ route('order.detail', $order->id )}}">{{ $order->code }}</a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                            </td>
                            <td>
                                <div><b>N:</b> {{$order->fullname}}</div>
                                <div><b>P:</b> {{$order->phone}}</div>
                                <div><b>A:</b> {{$order->address}}</div>
                            </td>
                            <td>
                                {{-- <b>{{ convert_price($order->promotion['discount'], true) }}</b> --}}
                                 <b>1.000.000</b>
                            </td>
                            <td>
                                <b>{{ convert_price($order->shipping, true) }}</b>
                            </td>
                            <td>
                                {{-- <b>{{ convert_price($order->cart['cartTotal'], true) }}</b> --}}
                                 <b>38.000.000</b>
                            </td>
                            <td>
                                {!! ($order->confirm != 'cancle') ? __('cart.confirm')[$order->confirm] : '<span
                                class="cancle-badge badge bg-danger-subtle text-danger"><i class="fas fa-xmark me-1"></i>  '.__('cart.confirm')[$order->confirm].'</span>' !!}
                            </td>
                            @foreach (__('cart') as $keyItem => $item)
                            @if ($keyItem === 'confirm') @continue @endif
                                <td class="text-center">
                                    @if ($order->confirm != 'cancle')
                                        <select name="{{ $keyItem }}" class="setUpSelect2 form-control updateBadge"
                                        data-field="{{ $keyItem }}">
                                            @foreach ($item as $keyOption => $option)
                                                @if ($keyOption === 'none') @continue @endif
                                                <option {{ ($keyOption == $order->{$keyItem}) ? 'selected' : '' }}
                                                    value="{{ $keyOption }}">{{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        -
                                    @endif
                                    <input type="hidden" class="changeOrderStatus" value="{{ $order->{$keyItem} }}">
                                </td>
                            @endforeach
                            {{-- <td>
                                {{ __('cart.payment')[$order->payment] }}
                            </td> --}}
                            <td style="width: 100px">
                                {{ array_column(__('payment.method'), 'title', 'name')[$order->method] ?? '-' }}
                                <input type="hidden" class="confirm" value="{{ $order->confirm }}">
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
    {{  $orders->links('pagination::bootstrap-4') }}
</div>
