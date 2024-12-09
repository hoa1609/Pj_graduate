<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title">Thông tin chung</h4>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <label class="form-label">Tiêu đề nhóm bài viết
                    <span class="text-danger fs-10"> (*)</span>
                </label>
                <input type="text" 
                name="translate_name" 
                class="form-control" 
                placeholder="nhập tên bài viết..." 
                value="{{ old('translate_name', ($objectTranslate-> name) ?? '' ) }}"
                >
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12 position-relative">
                <label class="form-label">Mô tả ngắn</label>
                <textarea name="translate_description" 
                    class="form-control textarea-10 ck-editor" 
                    placeholder="nhập mô tả"
                    id="ckDescription_1" 
                    {{-- {{ (isset($disabled)) ? 'disabled' : '' }}  --}}
                    data-height="150"
                >
                {{ old('translate_name', ($objectTranslate-> description) ?? '' ) }}
            </textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 position-relative">
                <div class="uk-flex uk-flex-space-between">
                    <label class="form-label">Nội dung</label>
                    <a href="" 
                        class="multipleUploadImageCkeditor" 
                        data-target="ckContent">
                        Upload nhiều hình ảnh
                    </a>
                </div>
                <textarea name="translate_content" 
                    class="form-control textarea-10 ck-editor" 
                    rows="5" placeholder="nhập mô tả"
                    id="ckContent_1" 
                    data-height="300">
                    {{ old('translate_name', ($objectTranslate-> content) ?? '' ) }}
                </textarea>
            </div>
        </div>
    </div>
</div>