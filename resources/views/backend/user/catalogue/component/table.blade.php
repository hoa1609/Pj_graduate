<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th>
                    <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem" >
                </th>
                <th>Tên nhóm thành viên</th>
                <th>Số thành viên</th>
                <th>Ghi chú</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($userCatalogues as $userCatalogue)
                    <tr>
                        <td><input type="checkbox" value="{{ $userCatalogue->id }}" class="form-check-input checkBoxItem"></td>
                        <td> {{ $userCatalogue->name }}</td>
                        <td>{{ $userCatalogue->users_count}} người </td>
                        <td> {{ $userCatalogue->description }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status"
                                data-field="publish"
                                data-model="UserCatalogue"
                                value="{{ $userCatalogue->publish }}"
                                type="checkbox"
                                id="flexSwitchCheckDefault"
                                {{ $userCatalogue->publish == 2 ? 'checked' : '' }}
                                data-modeId="{{ $userCatalogue->id }}"
                                >
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}"><i class="las la-pen text-secondary" style="font-size: 22px; padding-right: 5px"></i></a>
                            <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}"><i class="las la-trash-alt text-secondary"  style="font-size: 22px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{  $userCatalogues->links('pagination::bootstrap-4') }}

    </div>
</div>
