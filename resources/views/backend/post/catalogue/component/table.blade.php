<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th>
                    <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem" >
                </th>
                <th>Tên nhóm</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @if (isset($postCatalogues) && is_object($postCatalogues))
                    @foreach ($postCatalogues as $postCatalogue)
                        <tr>
                            <td><input type="checkbox" value="{{ $postCatalogue->id }}" class="form-check-input checkBoxItem"></td>
                            <td>
                                {{ str_repeat('|----', (($postCatalogue->level > 0)?($postCatalogue->level - 1):0)).$postCatalogue->name }}
                            </td>

                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status"
                                    data-field="publish"
                                    data-model="PostCatalogue"
                                    value="{{ $postCatalogue->publish }}"
                                    type="checkbox"
                                    id="flexSwitchCheckDefault"
                                    {{ $postCatalogue->publish == 2 ? 'checked' : '' }}
                                    data-modeId="{{ $postCatalogue->id }}"
                                    >
                                </div>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}"><i class="las la-pen text-secondary" style="font-size: 22px; padding-right: 5px"></i></a>
                                <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}"><i class="las la-trash-alt text-secondary"  style="font-size: 22px;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{  $postCatalogues->links('pagination::bootstrap-4') }}

    </div>
</div>
