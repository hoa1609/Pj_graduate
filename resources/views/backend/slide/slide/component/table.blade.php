<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
                <tr>
                    <th>
                        <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem">
                    </th>
                    <th>Tên nhóm</th>
                    <th>Từ khóa</th>
                    <th>Danh sách hình ảnh</th>
                    <th>Tình trạng</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td><input type="checkbox" value="{{ $slide->id }}" class="form-check-input checkBoxItem"></td>
                        <td> {{ $slide->name }}</td>
                        <td> {{ $slide->keyword }}</td>
                        <td>
                            @if (isset($slide->items['1']))
                                @foreach ($slide->items['1'] as $item)
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['alt'] }}"
                                        style="max-width: 100px;">
                                @endforeach
                            @endif

                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status" data-field="publish" data-model="Slide"
                                    value="{{ $slide->publish }}" type="checkbox" id="flexSwitchCheckDefault"
                                    {{ $slide->publish == 2 ? 'checked' : '' }} data-modeId="{{ $slide->id }}">
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('slide.edit', $slide->id) }}"><i class="las la-pen text-secondary"
                                    style="font-size: 22px; padding-right: 5px"></i></a>
                            <a href="{{ route('slide.delete', $slide->id) }}"><i class="las la-trash-alt text-secondary"
                                    style="font-size: 22px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{ $slides->links('pagination::bootstrap-4') }}

    </div>
</div>
