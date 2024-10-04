<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th style="min-width: 90px;">Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $user-> id }}">                                                    
                        </th>
                        <td><img src="backend/assets/images/logos/lang-logo/chatgpt.png" alt="" class="rounded-circle thumb-md me-1 d-inline">
                        <td> {{ $user-> name }}</td>
                        <td> {{ $user-> phone }}</td>

                        </td>
                        <td>{{ $user-> email }}</td>
                        <td>{{ $user-> address }}</td>
                        <td>
                            <div class="text-center form-switch">
                                <input class="form-check-input status form-check-input-{{ $user-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="User" 
                                    value="{{ $user->publish }}"  
                                    data-modeId="{{ $user->id }}"
                                    {{ $user->publish == 1 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('user.edit', $user-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user-> id) }}" method="POST">
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
    {{  $users->links('pagination::bootstrap-4') }}
</div>