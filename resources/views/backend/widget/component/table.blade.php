<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered border">
            <thead class="table-light">
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                    </th>
                    <th>Tên Widget</th>
                    <th>Từ khóa</th>
                    <th>short_code</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($widgets as $widget)
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $widget-> id }}">
                    </th>
                    <td> {{ $widget-> name }}</td>
                    <td> {{ $widget-> keyword }}</td>
                    <td> {{ $widget-> short_code }}</td>
                    <td>
                        <div class="text-center form-switch">
                            <input class="form-check-input status js-switch-{{ $widget-> id }}"
                                type="checkbox"
                                data-field="publish"
                                data-model="widget"
                                value="{{ $widget->publish }}"
                                data-modeId="{{ $widget->id }}"
                                {{ $widget->publish == 2 ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td class="text-center">
                        <a class="pading-action" href="{{ route('widget.edit', $widget-> id) }}">
                            <i class="las la-pen text-secondary fs-18"></i>
                        </a>
                        <a class="pading-action" href="{{ route('widget.delete', $widget-> id) }}">
                            <i class="las la-trash-alt text-secondary fs-18"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $widgets->links('pagination::bootstrap-4') }}
</div>