<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Tên quyền</th>
                <th>Canonical</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $permission-> id }}">                                                    
                        </th>
                        <td> {{ $permission-> name }}</td>
                        <td> {{ $permission-> canonical }}</td>
                        <td class="text-end">                                                        
                            <a class="pading-action" href="{{ route('permission.edit', $permission-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('permission.delete', $permission-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $permissions->links('pagination::bootstrap-4') }}
</div>