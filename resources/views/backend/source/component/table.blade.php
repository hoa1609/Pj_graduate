<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered border">
            <thead class="table-light">
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                    </th>
                    <th>Tên source</th>
                    <th>Từ khóa</th>
                    <th>Mô tả</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sources as $source)
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $source-> id }}">
                    </th>
                    <td> {{ $source->name }}</td>
                    <td> {{ $source->keyword }}</td>
                    <td> {{ strip_tags(html_entity_decode($source->description)) }}</td>
                    <td>
                        <div class="text-center form-switch">
                            <input class="form-check-input status js-switch-{{ $source-> id }}"
                                type="checkbox"
                                data-field="publish"
                                data-model="Source"
                                value="{{ $source->publish }}"
                                data-modeId="{{ $source->id }}"
                                {{ $source->publish == 2 ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td class="text-center">
                        <a class="pading-action" href="{{ route('source.edit', $source-> id) }}">
                            <i class="las la-pen text-secondary fs-18"></i>
                        </a>
                        <a class="pading-action" href="{{ route('source.delete', $source-> id) }}">
                            <i class="las la-trash-alt text-secondary fs-18"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $sources->links('pagination::bootstrap-4') }}
</div>
