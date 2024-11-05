@include('backend.dashboard.component.nav', ['title' => $config['seo'][$config['method']]['title']])

<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12 border-end">
                            @include('backend.dashboard.component.formError')
                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin của chung của nhóm thành viên</h4>
                            @php
                                $url =
                                    $config['method'] == 'create'
                                        ? route('user.catalogue.store')
                                        : route('user.catalogue.update', $userCatalogue->id);
                            @endphp
                            <form action="{{ $url }}" method="post" class="p-4 pt-3">

                                @csrf
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Tên Nhóm
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', $userCatalogue->name ?? '') }}"
                                                placeholder="Nhập Tên Nhóm">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Ghi chú
                                            </label>
                                            <input class="form-control" type="text" name="description"
                                                value="{{ old('description', $userCatalogue->description ?? '') }}"
                                                placeholder="Nhập ghi chú">
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
