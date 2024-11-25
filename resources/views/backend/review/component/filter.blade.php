<div class="card-header">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="card-title">Danh sách bình luận mới nhất</h4>
        </div>
    </div>
</div>

<form action="{{ route('review.index') }}">
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
                    <div class="uk-search uk-flex uk-flex-middle uk-flex-nowrap input-group mr5">
                        <input
                            type="text"
                            name="keyword"
                            value="{{ request('keyword') ?: old('keyword') }}"
                            placeholder="Nhập Từ khóa bạn muốn tìm kiếm..." class="form-control"
                        >
                        <button type="submit" name="search" value="search" class="btn btn-primary btn-find">Tìm Kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
