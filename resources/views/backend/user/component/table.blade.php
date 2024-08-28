<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><img src="backend/assets/images/logos/lang-logo/chatgpt.png" alt="" class="rounded-circle thumb-md me-1 d-inline">
                        <td> {{ $user-> name }}</td>
                        <td> {{ $user-> phone }}</td>

                        </td>
                        <td>{{ $user-> email }}</td>
                        <td>{{ $user-> address }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch</label>
                            </div>
                        </td>
                        <td class="text-end">                                                       
                            <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                            <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $users->links('pagination::bootstrap-4') }}
</div>