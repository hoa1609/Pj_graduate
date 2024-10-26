<div class="card-header">
    <div class="row align-items-center">
        <div class="col">                      
            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>                      
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
                                <ul class="list-unstyled mb-0">
                                    <li class>
                                        <a href="#" class="changeStatusAll" data-value="2" data-field="publish" data-model="UserRole" >Active toàn bộ</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#" class="changeStatusAll" data-value="1" data-field="publish" data-model="UserRole" >Unactive toàn bộ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div>                                     
</div>

<form action="{{ route('user.role.index') }}">
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
                        $publish = request('publish') ? : old('publish');
                    @endphp

                    <select name="publish" class="form-control form-select setupSelect2 mr5">
                        @foreach (config('apps.general.publish') as $key => $val)
                            <option {{ ($publish == $key)  ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle uk-flex-nowrap input-group mr5">
                        <input 
                            type="text" 
                            name="keyword" 
                            value="{{ request('keyword') ?: old('keyword') }}" 
                            placeholder="Nhập Từ khóa bạn muốn tìm kiếm..." class="form-control"
                        >
                        <button type="submit" name="search" value="search" class="btn btn-primary btn-find">Tìm Kiếm</button>
                    </div>
                    <a href="{{ route('user.role.permission') }}" class="btn btn-warning btn-permission mr5"><i class="fa fa-user-cog mr5"></i>Phân quyền </a>

                    <a href="{{ route('user.role.create') }}" class="btn btn-danger form-control"><i class="fas fa-user-friends mr5"></i>Thêm nhóm </a>
                </div>
            </div>
        </div>
    </div>
</form>