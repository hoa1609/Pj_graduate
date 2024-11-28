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
                    <th>Ngày tạo</th>
                    <th>Người tạo</th>
                    <th>Tình trạng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $menu->id }}">
                        </th>

                        <td> </td>
                        <td> </td>

                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end uk-flex">
                            <a class="pading-action" href="{{ route('menu.edit', $menu->id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
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
    {{-- {{  $menus->links('pagination::bootstrap-4') }} --}}
</div>
