<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th>
                    <input type="checkbox" id="checkAll" class="form-check-input checkBoxItem" >
                </th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Nhóm thành viên</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" value="{{ $user->id }}" class="form-check-input checkBoxItem"></td>
                        <td>
                            <img src="{{ $user->image ? asset($user->image) : asset('backend/assets/images/logos/lang-logo/chatgpt.png') }}"
                            alt="User-image" class="rounded-circle thumb-md me-1 d-inline " style="object-fit: cover">
                        </td>
                        <td> {{ $user->name }}</td>
                        <td> {{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->user_catalogues->name }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input status"
                                data-field="publish"
                                data-model="User"
                                value="{{ $user->publish }}"
                                type="checkbox"
                                id="flexSwitchCheckDefault"
                                {{ $user->publish == 2 ? 'checked' : '' }}
                                data-modeId="{{ $user->id }}"
                                >
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('user.edit', $user->id) }}"><i class="las la-pen text-secondary" style="font-size: 22px; padding-right: 5px"></i></a>
                            <a href="{{ route('user.delete', $user->id) }}"><i class="las la-trash-alt text-secondary"  style="font-size: 22px;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{  $users->links('pagination::bootstrap-4') }}

    </div>
</div>
