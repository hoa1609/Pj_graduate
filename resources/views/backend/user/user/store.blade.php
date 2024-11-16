<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>
                        </div>
                    </div>
                </div>
                @include('backend.dashboard.component.errors')
                @php
                    $url = ($config['method'] == 'create') ? route('user.store') : route('user.update', $user-> id);
                @endphp
                <div class="card-body pt-0">
                    <form action="{{ $url }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Tên</label>
                                    <div class="col-sm-9">
                                        <input class="form-control"
                                        name="name"
                                        type="text"
                                         placeholder="nhập tên..."
                                         value="{{ old('name', ($user-> name) ?? '' ) }}"
                                         >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control"
                                        name="email"
                                        type="text"
                                        placeholder="nhập email..."
                                        value="{{ old('email', ($user-> email) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Điện thoại</label>
                                    <div class="col-sm-9">
                                        <input class="form-control"
                                        name="phone"
                                        type="tel"
                                        placeholder="nhập số điện thoại"
                                        value="{{ old('phone' , ($user-> phone) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Sinh nhật</label>
                                    <div class="col-sm-9">
                                        <input class="form-control"
                                        name="birthday"
                                        type="date"
                                        value="{{ old('birthday', (isset($user-> birthday)) ? date('Y-m-d', strtotime($user-> birthday)) : '') }}"
                                        >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Ảnh</label>
                                    <div class="col-sm-9">
                                        <input class="form-control upload-image"
                                        name="image"
                                        type="text"
                                         placeholder="nhập ..."
                                         value="{{ old('image', ($user-> image) ?? '' ) }}"
                                         data-type="Images"
                                         >
                                    </div>
                                </div>

                                @if($config['method'] == 'create' )
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Mật khẩu</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"
                                            name="password"
                                            type="password"
                                            placeholder="nhập mật khẩu"
                                            >
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">Nhập lại mật khẩu</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"
                                            name="re_password"
                                            type="password"
                                            placeholder="nhập lại mật khẩu"
                                            >
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-lg-6">
                                <div class="row pb-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Nhóm thành viên</label>
                                        <select name="user_role_id" class="form-select" >
                                            @foreach(config('apps.general.roleUser') as $key => $item)
                                                <option {{$key == old('user_role_id', (isset($user->user_role_id)) ? $user->user_role_id : '') ? 'selected' : ''
                                                    }}  value="{{ $key }}">{{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row pb-4 text-start">
                                    <div class="col-lg-6 mb40">
                                        <label class="form-label">Thành phố</label>
                                        <select name="province_id" class="form-select setUpSelect2 province location" data-target="districts">
                                            <option value="0">[Chọn Thành Phố]</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province-> code }}" {{ old('province_id') == $province->code }}>
                                                        {{ $province-> name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 pd-2">
                                        <label class="form-label">Quận/Huyện</label>
                                        <select name="district_id" class="form-select setUpSelect2 districts location" data-target="wards">
                                            <option value="0">[Chọn Quận/Huyện]</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px">
                                        <label class="form-label">Phường/Xã</label>
                                        <select name="ward_id" class="form-select setUpSelect2 wards">
                                            <option value="0">[Chọn Phường/Xã]</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 10px">
                                        <label class="form-label">Địa chỉ</label>
                                        <input class="form-control"
                                            name="address"
                                            placeholder="nhập rõ địa chỉ..."
                                            value="{{ old('address', ($user-> address) ?? '' ) }}"
                                            >
                                    </div>
                                </div>
                                <div class="row pb-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Ghi chú</label>
                                        <input class="form-control"
                                        name="description"
                                        placeholder="nhập ghi chú..."
                                        value="{{ old('description', ($user-> description ) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}'
</script>
