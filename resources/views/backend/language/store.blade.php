@include('backend.dashboard.component.nav', ['title' => $config['seo']['create']['title']])

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12 border-end">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin của chung của nhóm thành viên</h4>
                            @php
                                $url =
                                    $config['method'] == 'create'
                                        ? route('language.store')
                                        : route('language.update', $language->id);
                            @endphp
                            <form action="{{ $url }}" method="post" class="p-4 pt-3">

                                @csrf
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Tên Ngôn Ngữ
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', $language->name ?? '') }}"
                                                placeholder="Nhập Tên Ngôn Ngữ">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Tên Viết Tắt
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="canonical"
                                                value="{{ old('canonical', $language->canonical ?? '') }}"
                                                placeholder="Nhập Tên Viết Tắt">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Hình ảnh
                                            </label>
                                            <input class="form-control upload-image" type="text" name="image"
                                                value="{{ old('image', $language->image ?? '') }}"
                                                data-type="Images">
                                                <img src="{{ old('image', $language->image ?? '') }}" alt="{{$language->name ?? ''}}" class="custom-img pt-1" style="max-width: 100%; height: auto; display: {{ old('image', $language->image ?? '') ? 'block' : 'none' }};">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Mô tả
                                            </label>
                                            <input class="form-control" type="text" name="description"
                                                value="{{ old('description', $language->description ?? '') }}"
                                                placeholder="Nhập Mô Tả">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>

                                </div><!--end col-->
                            </form> <!--end form-->
                        </div><!--end col-->

                    </div><!--end row-->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->
