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
                    $url = ($config['method'] == 'create') ? route('customer.store') : route('customer.update', $customer-> id);
                @endphp
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12">
                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin của chung</h4>
                            <form action="{{ $url }}" method="post" class="p-4 pt-3">
                                @csrf
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Email
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{ old('email', ($customer->email) ?? '') }}" placeholder="Nhập địa chỉ email">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Họ Tên
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', ($customer->name) ?? '') }}" placeholder="Nhập Họ và Tên">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Nhóm Khách Hàng
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <select class="form-select setupSelect2" name="customer_catalogue_id" id="">
                                                <option value="0">Chọn Nhóm Khách Hàng</option>
                                                @foreach($customerCatalogues as $customerCatalogue)
                                                    <option value="{{ $customerCatalogue->id }}"
                                                        {{ old('customer_catalogue_id', isset($customer) ? $customer->customer_catalogue_id : null) == $customerCatalogue->id ? 'selected' : '' }}>
                                                        {{ $customerCatalogue->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Nguồn Khách Hàng
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <select class="form-select setupSelect2" name="source_id" id="">
                                                <option value="0">Chọn Nguồn Khách Hàng</option>
                                                @foreach($sources as $source)
                                                    <option value="{{ $source->id }}"
                                                        {{ old('source_id', isset($customer) ? $customer->source_id : null) == $source->id ? 'selected' : '' }}>
                                                        {{ $source->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                                value="{{ old('image', $customer->image ?? '') }}"
                                                data-type="Images">
                                                <img src="{{ old('image', $customer->image ?? '') }}" alt="{{$customer->name ?? ''}}" class="custom-img pt-1" style="max-width: 100%; height: auto; display: {{ old('image', $customer->image ?? '') ? 'block' : 'none' }};">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Ngày Sinh
                                            </label>
                                            <input class="form-control" type="date" name="birthday"
                                                value="{{ old('birthday', isset($customer) ? \Carbon\Carbon::parse($customer->birthday)->format('Y-m-d') : '') }}" placeholder="Nhập ngày sinh">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <h4 class="card-title fs-16 pb-2 ">Thông tin liên hệ</h4>
                                    <div class="form-group mb-2 mb-lg-1">
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Tỉnh/Thành Phố</label>
                                                <select class="form-select setUpSelect2 province location"
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
                                                <select class="form-select setUpSelect2 districts location"
                                                    name="district_id" data-target="wards">
                                                    <option value="0">[Chọn Quận/Huyện]</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Phường/Xã</label>
                                                <select class="form-select setupSelect2 wards " name="ward_id">
                                                    <option value="0">[Chọn Phường/Xã]</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Địa Chỉ</label>
                                                <input class="form-control" type="text" name="address"
                                                    value="{{ old('address', ($customer->address) ?? '') }}" placeholder="Nhập địa chỉ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                                <label class="form-label">Số Điện Thoại</label>
                                                <input class="form-control" type="text" name="phone"
                                                    value="{{ old('phone', ($customer->phone) ?? '') }}" placeholder="Nhập số điện thoại">
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
        </div>
    </div>
</div>

<script>
    var province_id = '{{ (isset($customer->province_id)) ? $customer->province_id : old('province_id') }}'
    var district_id = '{{ (isset($customer->district_id)) ? $customer->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($customer->ward_id)) ? $customer->ward_id : old('ward_id') }}'
</script>
