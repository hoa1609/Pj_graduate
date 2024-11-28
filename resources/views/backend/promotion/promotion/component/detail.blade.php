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
