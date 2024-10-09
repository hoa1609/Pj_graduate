<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Thêm nhóm ngôn ngữ</h4>                      
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
                    $url = ($config['method'] == 'create') ? route('language.store') : route('language.update', $language-> id);
                @endphp
                <div class="card-body pt-0">
                    <form action="{{ $url }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end">Tên</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" 
                                        name="name" 
                                        type="text"
                                         placeholder="nhập tên ngôn ngữ..."
                                         value="{{ old('name', ($language-> name) ?? '' ) }}"
                                         >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end">Ảnh</label>
                                    <div class="col-sm-10">
                                        <input class="form-control upload-image" 
                                        name="image" 
                                        type="text"
                                         placeholder="nhập ..."
                                         value="{{ old('image', ($language-> image) ?? '' ) }}"
                                         data-type="Images"
                                         >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">  
                                <div class="mb-3 row" >
                                    <label for="example-password-input" class="col-sm-2 col-form-label text-end">Từ điển</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" 
                                        name="canonical"
                                        type="text" 
                                        placeholder="ví dụ: vn, en, cn,.."
                                        value="{{ old('canonical', ($language-> canonical) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                                <div class="mb-3 row" >
                                    <label for="example-password-input" class="col-sm-2 col-form-label text-end">Ghi chú</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" 
                                        name="description"
                                        type="text" 
                                        placeholder="nhập ghi chú..."
                                        value="{{ old('description', ($language-> description) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="text-end"> 
                                <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                            </div>
                        </div>
                    </form>               
                </div>
            </div>
        </div>                                                       
    </div>
</div>
