<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Cài đặt cấu hình chung</h4>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('system.store') }}" method="post"> 
    @csrf
    <div class="container-xxl">
        @foreach ($systemConfig as $key =>$val)
        <div class="row justify-content-star">
            <div class="col-lg-5 col-md-5">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col pb-2">
                                    <h4 class="card-title fs-16">Thêm mới nhóm bài viết</h4>
                                </div>
                                <div class="description-title">
                                    {{ $val['description'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="card">
                    <div class="card-header">
                        @if (count($val['value']))
                            @foreach ($val['value'] as $keyVal => $item)
                                @php
                                    $name = $key.'_'.$keyVal;
                                @endphp
    
                                <div class="row mb-2">
                                    <div class="col-md-12 position-relative">
                                        <label class="form-label">
                                            {{ $item['label'] }}{!! renderSystemLink($item) !!}
                                        </label>
                                       
                                        @switch($item['type'])
                                            @case('text')
                                                {!! renderSystemInput($name, $systems) !!}
                                                @break
                                            @case('images')
                                                {!! renderSystemImages($name, $systems) !!}
                                                @break
                                            @case('textarea')
                                                {!! renderSystemTextarea($name, $systems) !!}
                                                @break
                                            @case('select')
                                                {!! renderSystemSelect($item, $name, $systems) !!}
                                                @break
                                                
                                            @default
                                        @endswitch
    
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-end pb-3"> 
            <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </div>
</form>


