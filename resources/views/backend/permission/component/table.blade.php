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
                <th>Thao tác</th>
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
                        
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('permission.edit', $permission-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('permission.destroy', $permission-> id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="button_none pading-action" style="submit"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $permissions->links('pagination::bootstrap-4') }}
</div>