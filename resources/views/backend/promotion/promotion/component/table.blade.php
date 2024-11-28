<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
                <tr>
                    <th>
                        <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem">
                    </th>
                    <th>Tên chương trình</th>
                    <th>Chiết khấu</th>
                    <th>Thông tin</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Tình trạng</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($promotions as $promotion)
                @php
                    $startDate = coverDatetime($promotion->startDate);
                    $endDate = coverDatetime($promotion->endDate);
                    $status = '';
                    if($promotion->endDate !== NULL && strtotime($promotion->endDate) - strtotime(now()) <= 0 && !$promotion->neverEndDate) {
                        $status = '<span class="badge bg-danger-subtle text-danger"><i class="fas fa-xmark me-1"></i>Hết hạn</span>';
                    }

                @endphp
                    <tr>
                        <td><input type="checkbox" value="{{ $promotion->id }}" class="form-check-input checkBoxItem"></td>
                        <td class="promotion-name-container">
                            <div class="d-flex align-items-center">
                                <div class="promotion-name" title="{{ $promotion->name }}">
                                    {{ $promotion->name }}
                                </div>
                                <div class="ms-1 ">
                                    {!! $status !!}
                                </div>

                            </div>
                             <br>
                            Mã: <div class="badge bg-blue-subtle text-blue text-small">{{ $promotion->code }}</div>
                        </td>

                        <td>
                            <div class="discount-infomation">
                                {!! renderDiscountInformation($promotion) !!}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{ __('module.promotion')[$promotion->method] }}
                            </div>
                        </td>
                        <td> {{ $startDate }}</td>
                        <td> {{ ($promotion->neverEndDate === 'accept') ? 'Không giới hạn' : $endDate }} </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status js-switch-{{ $promotion->id }}"
                                    data-field="publish" data-model="Promotion"
                                    value="{{ $promotion->publish }}"
                                    type="checkbox" id="flexSwitchCheckDefault"
                                    data-modeId="{{ $promotion->id }}"
                                    {{ $promotion->publish == 2 ? 'checked' : '' }}
                                    >
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('promotion.edit', $promotion->id) }}"><i class="las la-pen text-secondary"
                                    style="font-size: 22px; padding-right: 5px"></i></a>
                            <a href="{{ route('promotion.delete', $promotion->id) }}"><i class="las la-trash-alt text-secondary"
                                    style="font-size: 22px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{ $promotions->links('pagination::bootstrap-4') }}
    </div>
</div>