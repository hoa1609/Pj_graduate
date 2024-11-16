<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                </th>
                <th>Tên nhóm khách hàng</th>
                <th>Số khách hàng</th>
                <th>Mô tả</th>
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($customerCatalogues as $customerCatalogue)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $customerCatalogue-> id }}">
                        </th>
                        <td> {{ $customerCatalogue->name }}</td>
                        <td> {{ $customerCatalogue->customers_count}}</td>
                        <td> {{ $customerCatalogue->description }}</td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $customerCatalogue-> id }}"
                                    type="checkbox"
                                    data-field="publish"
                                    data-model="CustomerCatalogue"
                                    value="{{ $customerCatalogue->publish }}"
                                    data-modeId="{{ $customerCatalogue->id }}"
                                    {{ $customerCatalogue->publish == 2 ? 'checked' : '' }}
                                    >
                            </div>
                        </td>
                        <td>
                            <a class="pading-action" href="{{ route('customer.catalogue.edit', $customerCatalogue-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('customer.catalogue.delete', $customerCatalogue-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- {{  $customerCatalogue->links('pagination::bootstrap-4') }} --}}
</div>
