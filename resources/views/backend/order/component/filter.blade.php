<div class="card-header">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>
        </div>
    </div>
</div>
<form action="{{ route('order.index') }}">
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
            @php
                $publish = request('publish') ? : old('publish');
                $keyword =  request('keyword') ?: old('keyword');
            @endphp

            <div class="action">
                <div class="action">
                    <div class="uk-flex uk-flex-middle">
                        @foreach (__('cart') as $key => $val)
                            @php
                                ${$key} = request($key) ?: old($key);
                            @endphp
                            <select name="{{ $key }}" class="form-control input-sm perpage filter mr10">
                                @foreach ($val as $index => $item)
                                    <option {{ ( ${$key} == $index)  ? 'selected' : '' }} value="{{ $index }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        @endforeach
                        <div class="uk-flex uk-flex-middle uk-flex-nowrap input-group mr5">
                            <input type="text"
                            name="keyword"
                            value="{{ $keyword }}"
                            placeholder="Tìm kiếm..."
                            class="form-control"
                            >
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-find">Tìm Kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
