<div class="card-header">
    <div class="row align-items-center">
        <div class="col">                      
            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>                      
        </div>
        
    </div>                                     
</div>

<form action="{{ route('permission.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class=""></div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <div class="uk-search uk-flex uk-flex-middle mr5">
                        <div class="input-group">
                            <input 
                                type="text" 
                                name="keyword" 
                                value="{{ request('keyword') ?: old('keyword') }}" 
                                placeholder="Nhập Từ khóa bạn muốn tìm kiếm..." class="form-control"
                            >
                           <span class="input-group-btn">
                               <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm Kiếm
                                </button>
                           </span>
                        </div>
                    </div>
                    <a href="{{ route('permission.create') }}" class="btn btn-lg btn-danger d-inline-flex px-2 align-items-center"><i class="fas fa-user-friends fs-10"></i>Thêm mới quyền</a>
                </div>
            </div>
        </div>
    </div>
</form>