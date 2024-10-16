@include('backend.dashboard.component.nav', ['title' => $config['seo']['create']['title']])

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12 border-end">
                            @include('backend.dashboard.component.formError')
                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin của chung</h4>
                            @php
                                $url = ($config['method'] == 'create') ? route('user.store') : route('user.update', $user->id) ;
                            @endphp
                            <form action="{{ $url }}" method="post" class="p-4 pt-3">

                                @csrf
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Email
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{ old('email', ($user->email) ?? '') }}" placeholder="Nhập địa chỉ email">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Họ Tên
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', ($user->name) ?? '') }}" placeholder="Nhập Họ và Tên">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Nhóm Thành Viên
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <select class="form-select setupSelect2" name="user_catalogue_id" id="">
                                                <option value="0">Chọn Nhóm Thành Viên</option>
                                                @foreach($userCatalogues as $userCatalogue)
                                                    <option value="{{ $userCatalogue->id }}"
                                                        {{ old('user_catalogue_id', isset($user) ? $user->user_catalogue_id : null) == $userCatalogue->id ? 'selected' : '' }}>
                                                        {{ $userCatalogue->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Ngày Sinh
                                            </label>
                                            <input class="form-control" type="date" name="birthday"
                                                value="{{ old('birthday', isset($user) ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}" placeholder="Nhập ngày sinh">
                                        </div>
                                    </div>
                                    @if($config['method'] == 'create')
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Mật Khẩu
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="password" name="password" value=""
                                                placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Nhập Lại Mật Khẩu
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="password" name="re_password"
                                                value="" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Ảnh Đại Diện
                                            </label>
                                            <input class="form-control upload-image" type="text" name="image"
                                                value="{{ old('image', $user->image ?? '') }}"
                                                data-type="Images">
                                                <img src="{{ old('image', $user->image ?? '') }}" alt="{{$user->name ?? ''}}" class="custom-img pt-1" style="max-width: 100%; height: auto; display: {{ old('image', $user->image ?? '') ? 'block' : 'none' }};">
                                        </div>
                                    </div>

                                </div><!--end col-->

                                <div class="col-lg-12 border-end">
                                    <h4 class="card-title fs-16 pb-2 ">Thông tin liên hệ</h4>

                                    <div class="form-group mb-2 mb-lg-1">
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Tỉnh/Thành Phố</label>
                                                <select class="form-select province location setupSelect2"
                                                    name="province_id" data-target="districts">
                                                    <option value="0">[Chọn Tỉnh/Thành Phố]</option>
                                                    @if (isset($provinces))
                                                        @foreach ($provinces as $province)
                                                        <option value="{{ $province->code }}" {{ old('province_id') == $province->code ? 'selected' : '' }}>
                                                            {{ $province->name }}
                                                        </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Quận/Huyện</label>
                                                <select class="form-select districts location setupSelect2"
                                                    name="district_id" data-target="wards">
                                                    <option value="0">[Chọn Quận/Huyện]</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Phường/Xã</label>
                                                <select class="form-select wards setupSelect2" name="ward_id">
                                                    <option value="0">[Chọn Phường/Xã]</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Địa Chỉ</label>
                                                <input class="form-control" type="text" name="address"
                                                    value="{{ old('address', ($user->address) ?? '') }}" placeholder="Nhập địa chỉ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Số Điện Thoại</label>
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ old('phone', ($user->phone) ?? '') }}" placeholder="Nhập số điện thoại">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>

                            </form> <!--end form-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->
<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}'
</script>
