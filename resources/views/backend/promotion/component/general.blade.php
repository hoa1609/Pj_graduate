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
            @if(!isset($offTitle))
                <div class="col-md-6 position-relative">
                    <label class="form-label">Tên chương trình
                        <span class="text-danger fs-10"> (*)</span>
                    </label>
                    <input type="text" name="name" class="form-control"
                        placeholder="Nhập tên chương trình..."
                        value="{{ old('name', $model->name ?? '') }}">
                </div>
            @endif
            <div class="col-md-6 position-relative">
                <label class="form-label">Mã khuyến mại
                    <span class="text-danger fs-10"> (*)</span>
                </label>

                <input type="text" name="code" class="form-control"
                    placeholder="Nhập tên mã khuyến mại hoặc hệ thống tự động tạo..."
                    value="{{ old('code', $model->code ?? '') }}">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 position-relative">
                <label class="form-label">Mô tả khuyến mại</label>
                <textarea name="description" class="form-control">{{ old('description', $model->description ?? null) }}</textarea>
            </div>
        </div>

    </div>
</div>
