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
    $url = ($config['method'] == 'create') ? route('product.catalogue.store') : route('product.catalogue.update',$productCatalogue-> id);
@endphp
<form action="{{ $url }}" method="post">
    @csrf
    <div class="container-xxl">
        <div class="row justify-content-star">
            <div class="col-md-9 col-lg-9">
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
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Tiêu đề nhóm bài viết 
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-control" 
                                    placeholder="nhập tên bài viết..."
                                    value="{{ old('name', ($productCatalogue-> name) ?? '' ) }}"
                                    >
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Mô tả ngắn</label>
                                <textarea 
                                    name="description" 
                                    class="form-control textarea-10 ck-editor" 
                                    placeholder="nhập mô tả"
                                    id="ckDescription"
                                    data-height="150"
                                    {{ (isset($disabled)) ? 'disabled' : '' }} 
                                    data-height="100"
                                    >
                                    {{ old('description', ($productCatalogue-> description) ?? '') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative">
                                <div class="uk-flex uk-flex-space-between">
                                    <label class="form-label">Nội dung</label>
                                    <a href="" class="multipleUploadImageCkeditor" data-target="ckContent">Upload nhiều hình ảnh</a>
                                </div>
                                <textarea 
                                    name="content" 
                                    class="form-control textarea-10 ck-editor" 
                                    rows="5" 
                                    placeholder="nhập mô tả"
                                    id="ckContent"
                                    data-height="300"
                                    >
                                    {{ old('content', ($productCatalogue-> content) ?? '') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- --}}
            <div class="col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative">
                                <label class="card-title fs-16">Chọn danh mục cha </label>
                                <div class="fs-10 mb-2"><span class="text-danger">*</span> Chọn root để tạo danh mục cha mới</div>
                                <select name="parent_id" class="form-select form-select-important">
                                    @foreach ($dropdown as $key => $val)
                                        <option {{ ($key == old('parent_id', $productCatalogue->parent_id ?? '')) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Chọn ảnh đại diện <span class="text-danger fs-10">(*)</span></label>
                            </div>
                            <span class="image img-cover image-target">
                                @php
                                    $image = old('image', $productCatalogue->image ?? ''); 
                                    $image = $image ?: 'backend/assets/images/no-img.jpg'; 
                                @endphp
                                <img src="{{ $image }}" alt="img" width="200px">
                            </span>
                            <input type="hidden" name="image" value="{{ old('image', ($productCatalogue-> image) ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative">
                                <label class="form-label mb-3">Chọn trình trạng 
                                    <span class="text-danger fs-10">(*)</span>
                                </label>
                                <div class="mb-2">
                                    <select name="publish" class="form-select form-select-important">
                                        @foreach (config('apps.general.publish') as $key => $val)
                                            <option {{ ($key == old('publish', $productCatalogue->publish ?? '')) ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <select name="follow" class="form-select form-select-important">
                                        @foreach (config('apps.general.follow') as $key => $val)
                                            <option {{ ($key == old('follow', $productCatalogue-> follow ?? ''))  ? 'selected' : '' }}  value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
        @include('backend.dashboard.component.album')
        
        <div class="row justify-content-star">
            <div class="col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Cấu hình SEO</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="ibox-content mb-3">
                            <div class="seo-container">
                                <div class="meta-title fs-5">
                                    {{ (old('meta_title', ($productCatalogue-> meta_title) ?? '' )) ?? 'Đây là tiêu đề cho bài viết' }}
                                </div>
                            </div>
                            <div class="canonical mb-2">
                                {{ ( ($productCatalogue-> canonical) ?? '') ? config('app.url').old('canonical', ($productCatalogue-> canonical) ?? '').config('apps.general.suffix') : 'http://duong-dan-cua-ban.html' }}
                            </div>
                            <div class="meta-description">
                                {{ (old('meta_description', ($productCatalogue-> meta_description) ?? '')) ?? 'Đây là mô tả bài viết.......' }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative">
                                <div class="uk-flex uk-flex-space-between">
                                    <label class="form-label">Tiêu đề SEO
                                        <span class="text-danger fs-10"> (*)</span>
                                    </label>
                                    <label>12 kí tự</label>
                                </div>
                                <input class="form-control" 
                                    name="meta_title" 
                                    type="text" 
                                    placeholder="nhập tên bài viết..."
                                    value="{{ old('meta_title', ($productCatalogue-> meta_title) ?? '' ) }}"
                                    >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative">
                                <div class="uk-flex uk-flex-space-between">
                                    <label class="form-label">Từ khóa SEO<span class="text-danger fs-10"> (*)</span></label>
                                    <label>12 kí tự</label>
                                </div>
                                <input class="form-control mb-2" 
                                name="meta_keyword"
                                placeholder="nhập từ khóa"
                                value="{{ old('meta_keyword', ($productCatalogue-> meta_keyword) ?? '' ) }}"
                                >
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative">
                                <div class="uk-flex uk-flex-space-between">
                                    <label class="form-label">Mô tả SEO <span class="text-danger fs-10"> (*)</span></label>
                                    <label>12 kí tự</label>
                                </div>
                                <textarea  
                                    class="form-control" 
                                    rows="3" 
                                    name="meta_description" 
                                    placeholder="nhập mô tả"
                                >{{ old('meta_description', ($productCatalogue-> meta_description) ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative">
                                <div class="uk-flex uk-flex-space-between">
                                    <label class="form-label">Đường dẫn url<span class="text-danger fs-10"> (*)</span></label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text baseUrl" id="basic-addon3">{{ config('app.url') }}</span>
                                    <input 
                                        type="text"
                                        class="form-control"
                                        name="canonical" 
                                        value="{{ old('name', ($productCatalogue-> canonical) ?? '' ) }}"
                                        >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
