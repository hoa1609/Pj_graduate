@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $url = $config['method'] == 'create' ? route('promotion.store') : route('promotion.update', $promotion->id);
@endphp
<form action="{{ $url }}" method="POST">
    @csrf
    <div class="container-xxl">
        <div class="row justify-content-star">
            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ $config['seo']['title'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-2">
                            <div class="col-md-6 position-relative">
                                <label class="form-label">Tên chương trình
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Nhập tên chương trình..."
                                    value="{{ old('name', $promotion->name ?? '') }}">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label">Mã khuyến mại</label>
                                <span class="text-danger fs-10"> (*)</span>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Nhập tên mã khuyến mại..."
                                    value="{{ old('code', $promotion->code ?? '') }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Mô tả khuyến mại</label>
                                <textarea name="description" class="form-control">{{ old('description', $promotion->description ?? null) }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Cài đặt thông tin chi tiết khuyến mãi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative mb-2">
                                <label class="form-label">Chọn hình thức khuyến mãi</label>
                                <select name="method" class="form-select setUpSelect2 promotionMethod">
                                    <option value="none">Chọn hình thức</option>
                                    @foreach (__('module.promotion') as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="promotion-container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- --}}
            <div class="col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative pb-2">
                                <label class="card-title fs-16">Thời gian áp dụng chương trình</label>
                                <div class="col-sm-12">
                                    <label class="form-label col-sm-12 col-form-label">Ngày bắt đầu <span
                                            class="text-danger fs-10"> (*)</span></label>
                                    <input class="form-control datepicker" type="datetime-local" name="startDate"
                                        id="startDate" value="{{ old('startDate', $promotion->startDate ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-12 position-relative pb-2">
                                <div class="col-sm-12">
                                    <label class="form-label col-sm-12 col-form-label">Ngày kết thúc</label>
                                    <input class="form-control datepicker" type="datetime-local" name="endDate"
                                        id="endDate" value="{{ old('endDate', $promotion->endDate ?? '') }}"
                                        @if (old('neverEndDate', $promotion->neverEndDate ?? '') == 'accept') readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                <input type="checkbox" name="neverEndDate" class="form-check-input me-2" value="accept"
                                    id="neverEnd"
                                    {{ old('neverEndDate', $promotion->neverEndDate ?? '') == 'accept' ? 'checked' : '' }}>
                                <label for="neverEnd" class="control-label">Không có ngày kết thúc</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="content-source">
                                <div class="col-md-12 position-relative pb-2">
                                    <label class="card-title fs-16">Nguồn khách áp dụng </label>
                                    @php
                                        $sourceStatus = old('source', $promotion->sourceStatus ?? null);
                                    @endphp
                                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                        <input type="radio" name="source" id="allSource"
                                            class="form-check-input me-2 chooseSource" value="all"
                                            {{ old('source', $promotion->sourceStatus ?? '') === 'all' || !old('source') ? 'checked' : '' }}>
                                        <label class="control-label" for="allSource">Áp dụng cho toàn bộ nguồn khách
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                    <input type="radio" name="source" id="chooseSource"
                                        class="form-check-input me-2 chooseSource" value="choose"
                                        {{ old('source', $promotion->sourceStatus ?? '') === 'choose' ? 'checked' : '' }}>
                                    <label class="control-label" for="chooseSource">Chọn nguồn khách áp dụng</label>
                                </div>
                            </div>
                            @if ($sourceStatus === 'choose')
                                @php
                                    $sourceValue = old('sourceValue', $promotion->sourceValue ?? []);
                                @endphp
                                <div class="source-wrapper">
                                    <select name="sourceValue[]" id="" class="multipleSelect2" multiple>
                                        @foreach ($sources as $key => $val)
                                            <option value="{{ $val->id }}"
                                                {{ in_array($val->id, $sourceValue) ? 'selected' : '' }}>
                                                {{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="content-apply">
                                <div class="col-md-12 position-relative pb-2">
                                    <label class="card-title fs-16">Đối tượng áp dụng </label>
                                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                        <input type="radio" name="applyStatus" id="allApply"
                                            class="form-check-input me-2 chooseApply" value="all"
                                            {{ old('applyStatus', $promotion->applyStatus ?? '') === 'all' || !old('applyStatus') ? 'checked' : '' }}>
                                        <label class="control-label" for="allApply">Áp dụng toàn bộ đối tượng
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                    <input type="radio" name="applyStatus" id="chooseApply"
                                        class="form-check-input me-2 chooseApply" value="choose"
                                        {{ old('applyStatus', $promotion->sourceStatus ?? '') === 'choose' ? 'checked' : '' }}>
                                    <label class="control-label" for="chooseApply">Chọn đối tượng đối tượng</label>
                                </div>
                            </div>
                            @php
                                $applyStatus = old('applyStatus', $promotion->applyStatus ?? null);
                                $applyValue = old('applyValue', $promotion->applyValue ?? []);
                            @endphp
                            @if ($applyStatus)
                                <div class="apply-wrapper">
                                    <select name="applyValue[]" id="" class="multipleSelect2 conditionItem" multiple>
                                        @foreach (__('module.applyStatus') as $key => $val)
                                            <option value="{{ $val['id'] }}"> {{ $val['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="wrapper-condition"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-end sticky-find mb-2">
                    <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
</form>
@include('backend.promotion.promotion.component.popup')
<input type="hidden" class="input-product-and-quantity" value="{{ json_encode(__('module.item')) }}">

<input type="hidden" class="applyStatusList" value="{{ json_encode(__('module.applyStatus')) }}">

<input type="hidden" name="" class="conditionItemSelected" value="{{ json_encode($applyValue) }}">
@if(count($applyValue))
    @foreach ($applyValue as $key => $val)
        <input type="hidden" name="" class="condition_input_{{ $val}}" value="{{ json_encode(old($val)) }}">
    @endforeach
@endif

<input type="hidden" name="" class="preload_promotionMethod" value="{{ old('method', ($promotion->method) ?? null) }}">
<input type="hidden" name="" class="preload_select-product-and-quantity" value="{{ old('module_type', ($promotion->method) ?? null) }}">
<input type="hidden" name="" class="input_order_amount_range" value="{{ json_encode( old('promotion_order_amount_range', ($promotion->promotion_order_amount_range) ?? [])) }}">
<input type="hidden" name="" class="input_product_and_quantity" value="{{ json_encode(old('product_and_quantity')) }}">
<input type="hidden" name="" class="input_object" value="{{ json_encode(old('object')) }}">
<script>
    $(document).on('input', '.form-control.int', function() {
        let value = $(this).val().replace(/\./g, '');
        if (/[^0-9]/.test(value)) {
            $(this).val(value.replace(/[^0-9]/g, ''));
            return;
        }
        // Định dạng lại giá trị với dấu phân cách nhóm hàng nghìn
        if (!isNaN(value) && value !== '') {
            $(this).val(parseFloat(value).toLocaleString('de-DE'));
        }
    });
</script>
