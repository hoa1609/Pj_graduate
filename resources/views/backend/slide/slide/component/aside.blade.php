<div class="card">
    <div class="card-body">
        <div class="card-header p-0 pb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Tùy chỉnh cơ bản</h4>
                </div><!--end col-->
            </div> <!--end row-->
        </div>

        <div class="form-group mb-2 mb-lg-1">
            <div class="row">
                <div class="col-lg-col-12 mb-2 ">
                    <label class="form-label">Tên slide
                        <span class="text-danger">(*)</span>
                    </label>
                    <input class="form-control" type="text" name="name"
                        value="{{ old('name', $slide->name ?? '') }}" placeholder="Nhập tên slide">
                </div>
                <div class="col-lg-col-12 mb-2 ">
                    <label class="form-label">Từ khóa
                        <span class="text-danger">(*)</span>
                    </label>
                    <input class="form-control" type="text" name="keyword"
                        value="{{ old('keyword', $slide->keyword ?? '') }}" placeholder="Nhập từ khóa">
                </div>
            </div>

            <!-- <h3>Data:</h3> -->
            <div class="docs-data">
                <div class="input-group mb-2 ">
                    <span class="input-group-text">Chiều rộng</span>
                    <input type="text" class="form-control text-center int" name="setting[width]"
                        placeholder="width " style="height: 37px"
                        value="{{ old('setting.width', $slide->setting['width'] ?? null) }}">
                    <span class="input-group-text">px</span>
                </div>
                <div class="input-group mb-2 ">
                    <span class="input-group-text">Chiều cao</span>
                    <input type="text" class="form-control text-center int" name="setting[height]"
                        placeholder="height" style="height: 37px"
                        value="{{ old('setting.height', $slide->setting['height'] ?? null) }}">
                    <span class="input-group-text">px</span>
                </div>
                <div class="row mb-2">
                    <div class="col-5">
                        <label class="control-label">
                            Hiệu ứng
                        </label>
                    </div>
                    <div class="col-7">
                        <div class="form-group position-relative">
                            <select class="form-select setupSelect2" name="setting[animation]"
                                style="padding-right: 35px;">
                                @foreach (__('module.effect') as $key => $val)
                                    <option value="{{ $key }}"
                                        {{ old('setting.animation', $slide->setting['animation'] ?? null) == $key ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">
                        <label class="control-label">
                            Mũi tên
                        </label>
                    </div>
                    <div class="col-7">
                        <input type="checkbox" name="setting[arrow]" class="form-check-input" value="accept"
                            {{-- @if (!old() || old('setting.arrow', $slide->setting['arrow'] ?? null) == 'accept') checked="checked" @endif> --}}
                            {{ old('setting.arrow', $slide->setting['arrow'] ?? '') == 'accept' ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">
                        <label class="my-3 control-label">Điều hướng</label>
                    </div>
                    <div class="col-7">
                        @foreach (__('module.navigate') as $key => $val)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="setting[navigate]"
                                    id="navigate_{{ $key }}" value="{{ $key }}"
                                    {{-- {{ old('setting.navigate', !old() ? 'dots' : ($slide->setting['navigate']) ?? null) === $key ? 'checked' : '' }}> --}}
                                    {{ old('setting.navigate', $slide->setting['navigate'] ?? 'dots') == $key ? 'checked' : '' }}>
                                <label class="form-check-label" for="navigate_{{ $key }}">
                                    {{ $val }}
                                </label>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!--end col-->
<div class="card">
    <div class="card-body">
        <div class="card-header p-0 pb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Tùy chỉnh nâng cao</h4>
                </div><!--end col-->
            </div> <!--end row-->
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <label class="control-label">
                    Tự động chạy
                </label>
            </div>
            <div class="col-6">
                <input type="checkbox" name="setting[autoplay]" value="accept" class="form-check-input"
                    {{-- {{ old('setting.autoplay') == 'accept' ? 'checked' : '' }}> --}}
                    {{ old('setting.autoplay', $slide->setting['autoplay'] ?? '') == 'accept' ? 'checked' : '' }}>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <label class="control-label">
                    Dừng khi di chuột
                </label>
            </div>
            <div class="col-6">
                <input type="checkbox" name="setting[pauseHover]" value="accept" class="form-check-input"
                    {{-- {{ old('setting.pauseHover') == 'accept' ? 'checked' : '' }}> --}}
                    {{ old('setting.pauseHover', $slide->setting['pauseHover'] ?? '') == 'accept' ? 'checked' : '' }}>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <label class="control-label">
                    Chuyển ảnh
                </label>
            </div>
            <div class="col-6 position-relative">
                <input type="text" name="setting[animationDelay]" value="{{ old('setting.animationDelay', ($slide->setting['animationDelay']) ?? null) }}"
                    class="form-control input-with-unit text-center int" placeholder="">
                <span class="unit-text pe-2">ms</span>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <label class="control-label">
                    Tốc độ hiệu ứng
                </label>
            </div>
            <div class="col-6 position-relative">
                <input type="text" name="setting[animationSpeed]" value="{{ old('setting.animationSpeed', ($slide->setting['animationDelay']) ?? null) }}"
                    class="form-control input-with-unit text-center int" placeholder="">
                <span class="unit-text pe-2">ms</span>
            </div>
        </div>
    </div>
</div>