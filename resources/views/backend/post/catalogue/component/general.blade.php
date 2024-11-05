<div class="p-4 pt-3">
    <div class="form-group mb-2 mb-lg-1">
        <div class="row">
            <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                <label class="form-label">Tiêu đề nhóm bài viết
                    <span class="text-danger">(*)</span>
                </label>
                <input class="form-control" type="text" name="name"
                    value="{{ old('name', $postCatalogue->name ?? '') }}"
                    placeholder="Nhập Tên Nhóm">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                <label class="form-label">Mô tả ngắn</label>
                <textarea class="form-control ck-editor" name="description" id="ckDescription" data-height="150">{{ old('description', $postCatalogue->description ?? '') }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                <label class="form-label">Nội dung</label>
                <textarea class="form-control ck-editor" name="content" id="ckContent" data-height="500">{{ old('content', $postCatalogue->content ?? '') }}</textarea>
            </div>
        </div>
    </div>
</div>
