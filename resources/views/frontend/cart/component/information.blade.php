<div class="container-info mb-5">
    <div class="uk-flex uk-space-between">
        <h3 class="checkout-title">Thông tin đặt hàng</h3>
        <div class="login-checkout">
            <span>Bạn chưa có tài khoản? <a href="{{ route('login') }}" class="text-login">Đăng nhập</a></span>
        </div>
    </div>
    <div class="box-infor mt-4">
        <div class="row mb-2">
            <div class="col-lg-6 mb-2">
                <input 
                    type="text" 
                    name="fullname" 
                    value="{{ old('fullname') }}"
                    class="form-control border-h-5" 
                    placeholder="nhập họ và tên...">
                @if ($errors->has('fullname')) 
                    <label class="err-message">*
                            {{$errors->first('fullname') }}
                    </label>    
                @endif
            </div>
            <div class="col-lg-6">
                <input 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    class="form-control border-h-5" 
                    placeholder="nhập số điện thoại...">
                @if ($errors->has('phone')) 
                    <label class="err-message">*
                            {{$errors->first('phone') }}
                    </label>    
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-lg-12">
                <input 
                    type="text" 
                    name="email"
                    value="{{ old('email') }}" 
                    class="form-control border-h-5" 
                    placeholder="nhập địa chỉ email...">
                @if ($errors->has('email')) 
                    <label class="err-message">*
                            {{$errors->first('email') }}
                    </label>    
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-lg-4 mb-2">
                <select class=" form-control border-h-5 form-select province location" name="province_id" data-target="districts">
                    <option value="0">[Chọn thành phố]</option>
                    @foreach ($provinces as $key => $val)
                        <option value="{{ $val->code }}">{{ $val->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 mb-2">
                <select name="district_id" id="" class="form-control form-select border-h-5 districts location" data-target="wards">
                    <option value="0">[Chọn Quận huyện]</option>
                </select>
            </div>
            <div class="col-lg-4 mb-2">
                <select class="form-control border-h-5 form-select wards" name="ward_id" data-target="districts"> 
                    <option value="0">[Chọn phường xã]</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-12">
                <input 
                    type="text" 
                    name="address" 
                    value="{{ old('address') }}"
                    class="form-control border-h-5" 
                    placeholder="nhập địa chỉ đường...">
                @if ($errors->has('address')) 
                    <label class="err-message">*
                            {{$errors->first('address') }}
                    </label>    
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-lg-12">
                <input 
                    type="text" 
                    name="description"
                    value="{{ old('description') }}" 
                    class="form-control border-h-5" 
                    placeholder="nhập ghi chú...">
            </div>
        </div>
    </div>
</div>