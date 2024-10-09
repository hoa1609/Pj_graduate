<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Tên nhóm thành viên</th>
                <th>Số thành viên</th>
                <th>Mô tả</th>
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($userRoles as $userRole)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $userRole-> id }}">                                                    
                        </th>
                        <td> {{ $userRole-> name }}</td>
                        <td> {{ $userRole-> users_count }}</td>
                        <td> {{ $userRole->description }}</td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $userRole-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="UserRole" 
                                    value="{{ $userRole->publish }}"  
                                    data-modeId="{{ $userRole->id }}"
                                    {{ $userRole->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('user.role.edit', $userRole-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('user.role.destroy', $userRole-> id) }}" method="POST">
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
    {{-- {{  $userRole->links('pagination::bootstrap-4') }} --}}
</div>