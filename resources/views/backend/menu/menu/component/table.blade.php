<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                    </th>
                    <th>Tên Menu</th>
                    <th>Từ khóa</th>
                    <th>Tình trạng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($menuCatalogues) && is_object($menuCatalogues))
                    @foreach ($menuCatalogues as $menuCatalogue)
                        <tr>
                            <th style="width: 16px;">
                                <input type="checkbox" class="form-check-input checkBoxItem"
                                    value="{{ $menuCatalogue->id }}">
                            </th>

                            <td>{{ $menuCatalogue->name }}</td>
                            <td>{{ $menuCatalogue->keyword }}</td>
                            <td>
                                <div class="form-switch">
                                    <input class="form-check-input status js-switch-{{ $menuCatalogue->id }}"
                                        type="checkbox" data-field="publish" data-model="MenuCatalogue"
                                        value="{{ $menuCatalogue->publish }}" data-modeId="{{ $menuCatalogue->id }}"
                                        {{ $menuCatalogue->publish == 2 ? 'checked' : '' }}>
                                </div>
                            </td>

                            <td class="text-end uk-flex">
                                <a class="pading-action" href="{{ route('menu.edit', $menuCatalogue->id) }}">
                                    <i class="las la-pen text-secondary fs-18"></i>
                                </a>
                                <form action="{{ route('menu.delete', $menuCatalogue->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="button_none pading-action" style="submit"><i
                                            class="las la-trash-alt text-secondary fs-18"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
    {{-- {{  $menus->links('pagination::bootstrap-4') }} --}}
</div>
