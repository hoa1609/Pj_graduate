<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Thông tin cá nhân</h4>
                        </div>
                    </div>
                </div>
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
                    $url = ($config['method'] == 'create') ? route('user.catalogue.store') : route('user.catalogue.update', $userCatalogue-> id);
                @endphp
                <div class="card-body pt-0">
                    <form action="{{ $url }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end">Tên nhóm</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"
                                        name="name"
                                        type="text"
                                         placeholder="nhập tên nhóm..."
                                         value="{{ old('name', ($userCatalogue-> name) ?? '' ) }}"
                                         >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end">Ghi chú</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"
                                        name="description"
                                        type="text"
                                         placeholder="nhập ghi chú..."
                                         value="{{ old('description', ($userCatalogue-> description) ?? '' ) }}"
                                         >
                                    </div>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
