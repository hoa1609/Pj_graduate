<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Xóa ngôn ngữ</h4>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="uk-flex">
                <div class="description pt-3">
                    <p>Bạn đang muốn xóa ngôn ngữ có tên là: <span class="text-danger">{{ $language->name }}</span></p>
                    <p>Không thể khôi phục sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                </div>
            </div>
        </div> 
        <div class="col-6">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12 border-end">
                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin chung</h4>
                            <form action="{{ route('language.destroy', $language->id) }}" method="post" class="p-4 pt-3">
                                @csrf
                                @method('DELETE')
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Tên ngôn ngữ
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', ($language-> name) ?? '') }}" readonly>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                            <label class="form-label">Từ điển</label>
                                            <input class="form-control" type="text" name="description"
                                                value="{{ old('name', ($language-> canonical) ?? '') }}" readonly>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger mt-3">Xóa</button>
                                </div>
                            </form> 
                        </div>

                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div>
