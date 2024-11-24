<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title">Cấu hình SEO</h4>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <div class="uk-flex uk-flex-space-between">
                    <label class="form-label">Tiêu đề SEO
                        <span class="text-danger fs-10"> (*)</span>
                    </label>
                    <label>12 kí tự</label>
                </div>
                <input class="form-control" 
               name="translate_meta_title" 
               type="text" 
               placeholder="nhập tên bài viết..."
               value="{{ old('translate_meta_title', $objectTranslate->meta_title ?? '') }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <div class="uk-flex uk-flex-space-between">
                    <label class="form-label">Từ khóa SEO<span class="text-danger fs-10"> (*)</span></label>
                    <label>12 kí tự</label>
                </div>
                <input class="form-control mb-2" 
           name="translate_meta_keyword" 
           placeholder="nhập từ khóa" 
           value="{{ old('translate_meta_keyword', $objectTranslate->meta_keyword ?? '') }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <div class="uk-flex uk-flex-space-between">
                    <label class="form-label">Mô tả SEO 
                        <span class="text-danger fs-10"> (*)</span>
                    </label>
                    <label>12 kí tự</label>
                </div>
                <textarea name="translate_meta_description" 
                          class="form-control textarea-10 ck-editor" 
                          placeholder="nhập mô tả">{{ old('translate_meta_description', isset($objectTranslate->meta_description) ? $objectTranslate->meta_description : '') }}</textarea>
            </div>
            
        </div>
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <div class="uk-flex uk-flex-space-between">
                    <label class="form-label">Đường dẫn url<span class="text-danger fs-10"> (*)</span></label>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text baseUrl" id="basic-addon3">{{ config('app.url') }}</span>
                    <input type="text" 
                           class="form-control seo-canonical" 
                           name="translate_canonical" 
                           value="{{ old('translate_canonical', $objectTranslate->canonical ?? '') }}">
                </div>
                
            </div>
        </div>
        <div class="text-end sticky-find">
            <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </div>
</div>