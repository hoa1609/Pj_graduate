<div class="col-md-4 col-lg-4">
    <div class="card">
        <div class="card-body pt-10">
            <div class="row">
                <div class="col-md-12 position-relative pb-2">
                    <label class="card-title fs-16">Thời gian áp dụng chương trình</label>
                    <div class="col-sm-12">
                        <label class="form-label col-sm-12 col-form-label">Ngày bắt đầu <span class="text-danger fs-10">
                                (*)</span></label>
                        <input class="form-control datepicker" type="datetime-local" name="startDate" id="startDate"
                            value="{{ old('startDate', $model->startDate ?? '') }}">
                    </div>
                </div>
                <div class="col-md-12 position-relative pb-2">
                    <div class="col-sm-12">
                        <label class="form-label col-sm-12 col-form-label">Ngày kết thúc</label>
                        <input class="form-control datepicker" type="datetime-local" name="endDate" id="endDate"
                            value="{{ old('endDate', $model->endDate ?? '') }}"
                            @if (old('neverEndDate', $model->neverEndDate ?? '') == 'accept')
                                readonly
                                onfocus="this.removeAttribute('readonly');"
                            @endif>
                    </div>
                </div>
                <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                    <input type="checkbox" name="neverEndDate" class="form-check-input me-2" value="accept"
                        id="neverEnd"
                        {{ old('neverEndDate', $model->neverEndDate ?? '') == 'accept' ? 'checked' : '' }}>
                    <label for="neverEnd" class="control-label">Không có ngày kết thúc</label>
                </div>

            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body pt-10">
            <div class="row">
                <div class="content-source">
                    <div class="col-md-12 position-relative pb-2">
                        <label class="card-title fs-16">Nguồn khách áp dụng </label>
                        @php
                            $sourceStatus = old('source', $model->discountInformation['source']['status'] ?? null);
                        @endphp
                        <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                            <input type="radio" name="source" id="allSource"
                                class="form-check-input me-2 chooseSource" value="all"
                                {{ old('source', $model->discountInformation['source']['status'] ?? '') === 'all' || !old('source') ? 'checked' : '' }}>
                            <label class="control-label" for="allSource">Áp dụng cho toàn bộ nguồn khách
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                        <input type="radio" name="source" id="chooseSource"
                            class="form-check-input me-2 chooseSource" value="choose"
                            {{ old('source', $model->discountInformation['source']['status'] ?? '') === 'choose' ? 'checked' : '' }}>
                        <label class="control-label" for="chooseSource">Chọn nguồn khách áp dụng</label>
                    </div>
                </div>
                @if ($sourceStatus === 'choose')
                    @php
                        $sourceValue = old('sourceValue', $model->discountInformation['source']['data'] ?? []);
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
    </div> --}}
    {{-- <div class="card">
        <div class="card-body pt-10">
            <div class="row">
                <div class="content-apply">
                    <div class="col-md-12 position-relative pb-2">
                        <label class="card-title fs-16">Đối tượng áp dụng </label>
                        <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                            <input type="radio" name="applyStatus" id="allApply"
                                class="form-check-input me-2 chooseApply" value="all"
                                {{ old('applyStatus', $model->discountInformation['apply']['status'] ?? '') === 'all' || !old('applyStatus') ? 'checked' : '' }}>
                            <label class="control-label" for="allApply">Áp dụng toàn bộ đối tượng
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                        <input type="radio" name="applyStatus" id="chooseApply"
                            class="form-check-input me-2 chooseApply" value="choose"
                            {{ old('applyStatus', $model->discountInformation['apply']['status'] ?? '') === 'choose' ? 'checked' : '' }}>
                        <label class="control-label" for="chooseApply">Chọn đối tượng đối tượng</label>
                    </div>
                </div>
                @php
                    $applyStatus = old('applyStatus', $model->discountInformation['apply']['status'] ?? null);
                    $applyValue = old('applyValue', $model->discountInformation['apply']['data'] ?? []);
                @endphp
                @if ($applyStatus && !empty($applyValue))
                    <div class="apply-wrapper">
                        <select name="applyValue[]" id="" class="multipleSelect2 conditionItem" multiple>
                            @foreach (__('module.applyStatus') as $key => $val)
                                <option value="{{ $val['id'] }}" {{ in_array($val['id'], $applyValue) ? 'selected' : '' }}>
                                    {{ $val['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <div class="wrapper-condition"></div>
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="text-end sticky-find mb-2">
        <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
    </div>
</div>
<input type="hidden" class="input-product-and-quantity" value="{{ json_encode(__('module.item')) }}">
<input type="hidden" class="applyStatusList" value="{{ json_encode(__('module.applyStatus')) }}">
{{-- <input type="hidden" name="" class="conditionItemSelected" value="{{ json_encode($applyValue) }}"> --}}

{{-- @if(count($applyValue))
    @foreach ($applyValue as $key => $val)
        <input
            type="hidden"
            class="condition_input_{{ $val }}"
            value="{{ json_encode(old($val, ($model->discountInformation['apply']['condition'][$val]) ?? null)) }}"
        >
    @endforeach
@endif --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
     const neverEndDateCheckbox = document.querySelector('input[name="neverEndDate"]');
     const endDateInput = document.getElementById('endDate');

     function toggleEndDateInput() {
         endDateInput.disabled = neverEndDateCheckbox.checked;
     }

     toggleEndDateInput();

     neverEndDateCheckbox.addEventListener('change', toggleEndDateInput);
 });
 </script>
