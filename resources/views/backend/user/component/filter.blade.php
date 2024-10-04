<div class="card-header">
    <div class="row align-items-center">
        <div class="col">                      
            <h4 class="card-title">Quản lý thành viên</h4>                      
        </div>
        <div class="col-auto"> 
            <form class="row g-2">
                <div class="col-auto">
                    <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" data-bs-auto-close="outside">
                        <i class="iconoir-filter-alt me-1"></i> Cài đặt chung
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <div class="text-dark p-2">
                            <div class="form-check mb-2">
                                <a href="#" class="changeStatusAll" data-value="1" data-value="1" data-field="publish" data-model="User" >Publish toàn bộ</a>
                                <a href="#" class="changeStatusAll" data-value="1" data-value="0" data-field="publish" data-model="User" >Publish toàn bộ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div>                                     
</div>

<form action="{{ route('user.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                @php
                    $perpage = request('perpage') ? : old('perpage');
                @endphp
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-select">
                        @for($i = 20; $i<= 200; $i+=20)
                            <option {{ ($perpage == $i)  ? 'selected' : '' }}  value="{{ $i }}">{{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @php
                        $publish = request('publish') ?: old('publish');
                    @endphp
                    {{-- <select name="publish" class="form-control setupSelect2 ml10">
                        @foreach(config('apps.general.publish') as $key => $val)
                        <option {{ ($publish == $key)  ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select> --}}
                    <select name="user_catalogue_id" class="form-control form-select mr10 setupSelect2">
                        <option value="0" selected="selected">Chọn Nhóm Thành Viên</option>
                        <option value="1">Quản trị viên</option>
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle mr10">
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
                    <a href="{{ route('user.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
                </div>
            </div>
        </div>
    </div>
</form>