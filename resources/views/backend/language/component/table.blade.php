<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th>
                    <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem" >
                </th>
                <th>Hình ảnh</th>
                <th>Tên ngôn ngữ</th>
                <th>Tên viết tắt</th>
                <th>Mô tả</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($languages as $language)
                    <tr>
                        <td><input type="checkbox" value="{{ $language->id }}" class="form-check-input checkBoxItem"></td>
                        <td><img class="custom-img" src="{{ $language->image }}" alt="{{ $language->name }}"></td>
                        <td> {{ $language->name }}</td>
                        <td >{{ $language->canonical}}</td>
                        <td> {{ $language->description }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status"
                                data-field="active"
                                data-model="Language"
                                value="{{ $language->active }}"
                                type="checkbox"
                                id="flexSwitchCheckDefault"
                                {{ $language->active == 2 ? 'checked' : '' }}
                                data-modeId="{{ $language->id }}"
                                >
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('language.edit', $language->id) }}"><i class="las la-pen text-secondary" style="font-size: 22px; padding-right: 5px"></i></a>
                            <a href="{{ route('language.delete', $language->id) }}"><i class="las la-trash-alt text-secondary"  style="font-size: 22px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{  $languages->links('pagination::bootstrap-4') }}

    </div>
</div>
