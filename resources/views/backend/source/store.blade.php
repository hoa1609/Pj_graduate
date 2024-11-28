@include('backend.dashboard.component.formError')

@php
$url = ($config['method'] == 'create') ? route('source.store') : route('source.update',$source-> id);
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
                                {{ old('description', ($source->description) ?? '') }}
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
                                <label class="form-label">Tên nguồn khách <span class="text-danger fs-10">(*)</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Nhập tên nguồn khách..."
                                    value="{{ old('name', ($source->name) ?? '' ) }}">
                            </div>
                            <div class="col-md-12 position-relative pb-3">
                                <label class="form-label">Từ khóa nguồn <span class="text-danger fs-10">(*)</span></label>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    placeholder="Nhập từ khóa nguồn..."
                                    value="{{ old('keyword', ($source->keyword) ?? '' ) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end sticky-find">
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>

    </div>
</form>
