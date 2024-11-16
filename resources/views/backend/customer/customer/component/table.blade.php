<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                </th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Thuộc nhóm khách hàng</th>
                <th>Nguồn khách hàng</th>
                <th>Địa chỉ</th>
                <th style="min-width: 90px;">Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $customer-> id }}">
                        </th>
                        <td><img src="{{ ($customer->image) ?? '/userfiles/image/user/user-hiden.png' }}" alt="" class="rounded-circle thumb-md me-1 d-inline">
                        <td> {{ $customer->name }}</td>
                        <td> {{ $customer->phone }}</td>

                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->customer_catalogues->name ?? 'Chưa có nhóm'}}</td>
                        <td>{{ $customer->sources->name ?? 'Chưa có nguồn khách hàng'}}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <div class="text-center form-switch">
                                <input class="form-check-input status js-switch-{{ $customer-> id }}"
                                    type="checkbox"
                                    data-field="publish"
                                    data-model="Customer"
                                    value="{{ $customer->publish }}"
                                    data-modeId="{{ $customer->id }}"
                                    {{ $customer->publish == 2 ? 'checked' : '' }}
                                    >
                            </div>
                        </td>
                        <td class="text-end">
                            <a class="pading-action" href="{{ route('customer.edit', $customer-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('customer.delete', $customer-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{  $customers->links('pagination::bootstrap-4') }}
</div>
