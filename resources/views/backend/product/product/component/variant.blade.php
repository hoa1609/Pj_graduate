<div class="row">
    <div class="col-md-9 col-lg-9">
        <div class="card m-0">
            <div class="card-header">
                <div class="row pb-2">
                    <h4 class="card-title pb-1">Sản phẩm có nhiều phiên bản</h4>
                    <span class="text-small">*Sản phẩm có nhiều phiên bản với các thuộc tính khác nhau mà người dùng có thể lựa chọn, như <strong class="text-danger">màu sắc</strong> hoặc <strong class="text-danger">kích thước</strong>....</span>
                </div>
                <div class="uk-flex uk-flex-middle">
                    <input 
                        type="checkbox" 
                        name="accept" 
                        class="form-check-input checkBoxItem mr10 turnOnVariant" 
                        value="1"
                        {{ old('accept') == 1 ?'checked' : '' }}
                    >
                    <label>Thêm thuộc tính sản phẩm</label>
                </div>
            </div>
            <div class="card-body variant-wrapper pb-5 {{ old('accept') == 1 ?'' : 'hidden' }}">
                <div class="row mb-1">
                    <div class="col-lg-3 position-relative">
                        <div class="attribute-title">Chọn thuộc tính</div>
                    </div>
                    <div class="col-lg-8 position-relative">
                        <div class="attribute-title">Chọn giá trị thuộc tính</div>
                    </div>
                </div>
                <div class="variant-body container">
                    {{-- nội dung attribute (color & size,...)  --}}
                    @if (old('attributeCatalogue'))
                        @foreach (old('attributeCatalogue') as $keyAttr => $valAttr)
                            <div class="row pb-2 variant-item"> 
                                <div class="col-lg-3 p-0">
                                    <div class="attribute-catalogue">
                                        <select name="attributeCatalogue[]" id="" class="select-option choose-attribute niceSelect">
                                            <option value="">-- Chọn thuộc tính --</option>
                                            @foreach ($attributeCatalogue as $key => $val)
                                                <option {{ $valAttr == $val->id ? 'selected' : '' }} value="{{ $val-> id }}">
                                                    {{ $val-> attribute_catalogue_language->first()->name }}
                                                <option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    {{-- <input type="text" name="" disabled class="fake-variant form-control hight-42"> --}}
                                    <select name="attribute[{{ $valAttr }}][]" class="selectVariant variant-{{ $valAttr }} form-control" multiple data-catid="{{ $valAttr }}"></select>
                                </div>
                                <div class="col-lg-1">
                                    <button type="button" class="remove-attribute btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="variant-foot">
                    <button type="button" class="add-variant">Thêm thuộc tính</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header p-0">
                <div class="table-responsive px-3 pb-3">
                    <table class="table table-centered  mb-3 variantTable">
                        <thead></thead>
                        <tbody></tbody>
                        {{-- nội dung table --}}
                    </table>                    
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    var attributeCatalogue = @json($attributeCatalogue->map(function($item){
        $name = optional($item->attribute_catalogue_language->first())->name;
        return [
            'id' => $item->id,
            'name' => $name
        ];
    })->values());

    var attribute = '{{ base64_encode(json_encode(old('attribute'))) }}'
    var variant = '{{ base64_encode(json_encode(old('variant'))) }}'
</script>
