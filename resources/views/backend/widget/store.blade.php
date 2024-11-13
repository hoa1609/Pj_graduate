@include('backend.dashboard.component.formError')

@php
$url = ($config['method'] == 'create') ? route('widget.store') : route('widget.update',$widget-> id);
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
                                    data-height="100">
                                {{ old('description', ($widget-> description) ?? '') }}
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
                                <label class="card-title fs-16">Cài đặt cơ bản </label>
                            </div>
                            <div class="col-md-12 position-relative pb-3">
                                <label class="form-label">Tên widget <span class="text-danger fs-10">(*)</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="nhập tên widget..."
                                    value="{{ old('name', ($widget->name) ?? '' ) }}">
                            </div>
                            <div class="col-md-12 position-relative pb-3">
                                <label class="form-label">Từ khóa widget <span class="text-danger fs-10">(*)</span></label>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    placeholder="nhập từ khóa widget..."
                                    value="{{ old('keyword', ($widget->keyword) ?? '' ) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Short code <span class="text-danger fs-10">(*)</span></label>
                            </div>
                            <textarea name="short_code" class="form-control" id="">{{old('short_code', ($widget->short_code) ?? '' )}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end sticky-find">
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
        @include('backend.dashboard.component.album',['model' => $widget ?? null])
        <div class="row justify-content-star">
            <div class="col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Cấu hình nội dung widget</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-2">
                            <div class="col-12">
                                <h6 class="mb-2">Chọn model</h6>
                                @foreach(__('module.model') as $key => $val)
                                <div class="form-check mb-2 ">
                                    <input class="form-check-input" type="radio"
                                        value="{{ $key }}"
                                        id="{{ $key }}"
                                        name="model"
                                        {{ (old('model',($widget->model) ?? '' ) == $key )? "checked" : '' }}>
                                    <label class="form-check-label" for="{{ $key }}">
                                        {{ $val }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="col-12 mt-3 mb-2">
                                <div class="d-flex search-model-box ">
                                    <i class="fa fa-search"></i>
                                    <input class="form-control search-model" id="search-model" type="text" placeholder="Search" aria-label="Search">

                                    <div class="col-12 ajax-search-result shadow ">
                                        <div class="search-model-result">
                                            <ul class="list-group ajax-search-result-li">

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-12">

                                @php
                                $modelItem = old('model_id', ($widgetItem) ?? null);
                                @endphp
                                <div class="search-model-result">
                                    <ul class="list-group search-model-item">
                                        <!--  -->
                                        @if(!is_null($modelItem))
                                        @foreach($modelItem['id'] as $key => $val)
                                        <li class="d-flex justify-content-between border-bottom p-2 "
                                            id="model-{{ $val }}"
                                            data-model-id="{{ $val }}">
                                            <div class="image">
                                                <img src="{{ $modelItem['image'][$key] }}" alt="" width="40px" height="40px">
                                                <span class="name mx-2 fs-6">{{ $modelItem['name'][$key] }}</span>
                                                <div class="hidden">
                                                    <input type="text" name="model_id[id][]" value="{{ $val }}">
                                                    <input type="text" name="model_id[name][]" value="{{ $modelItem['name'][$key] }}">
                                                    <input type="text" name="model_id[image][]" value="{{ $modelItem['image'][$key] }}">
                                                </div>
                                            </div>
                                            <div class="delete ">
                                                <button type="button" class="btn-close" aria-label="Close"></button>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>