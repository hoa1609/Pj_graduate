<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                    </th>
                    <th>Ảnh</th>
                    <th>Tên Nhóm Thành Viên</th>
                    {{-- <th>Số Thành Viên</th> --}}
                    <th>Mô Tả</th>
                    <th style="text-align: center;">Tình trạng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($usersCatalogues as $userCatalogue)
                        <tr>
                            <th style="width: 16px;">
                                <input type="checkbox" class="form-check-input checkBoxItem"
                                    value="{{ $userCatalogue->id }}">
                            </th>
                            <td><img src="backend/assets/images/logos/lang-logo/chatgpt.png" alt=""
                                    class="rounded-circle thumb-md me-1 d-inline">
                            <td> {{ $userCatalogue->name }}</td>
                            <td> {{ $userCatalogue->description }}</td>
                            <td>
                                <div class="text-center form-switch">
                                    <input class="form-check-input status js-switch-{{ $userCatalogue->id }}"
                                        type="checkbox" data-field="publish" data-model="User"
                                        value="{{ $userCatalogue->publish }}" data-modeId="{{ $userCatalogue->id }}"
                                        {{ $userCatalogue->publish == 1 ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-end uk-flex">
                                <a class="pading-action" href="{{ route('user.catalogue.edit', $userCatalogue->id) }}">
                                    <i class="las la-pen text-secondary fs-18"></i>
                                </a>
                                <form action="{{ route('user.catalogue.destroy', $userCatalogue->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="button_none pading-action" style="submit"><i
                                            class="las la-trash-alt text-secondary fs-18"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    {{ $usersCatalogues->links('pagination::bootstrap-4') }}
</div>
