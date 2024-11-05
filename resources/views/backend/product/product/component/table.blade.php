<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Hình ảnh</th>
                <th>Bài viết</th>
                <th>Vị trí</th>
                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $product-> id }}">                                                    
                        </th>
                        <th><img loading="lazy" src="{{ $product-> image}}" alt="image" width="50px"></th>
                        <td>
                            <div class="uk-flex flex-direction-column">
                                <div class="fsz-5">{{ $product->name }}</div>
                                <div class="uk-flex">
                                    <div class="category">
                                        <span class="color-note">Nhóm hiển thị: </span>
                                    </div>
                                    <div class="text-danger">
                                        @foreach ($product-> product_catalogues as $val)
                                            @foreach ($val-> product_catalogue_language as $cat)
                                                <a href="{{ route('product.index', ['product_catalogue_id' => $val-> id]) }}">{{ $cat-> name }} |</a>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="text" name="form-control" data-id="{{ $product->id }}" data-model="{{ $config['model'] }}" value="{{ $product-> order }}">
                        </td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $product-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="{{ $config['model'] }}" 
                                    value="{{ $product->publish }}"  
                                    data-modeId="{{ $product->id }}"
                                    {{ $product->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end">                                                        
                            <a class="pading-action" href="{{ route('product.edit', $product-> id) }}">
                                <i class="las la-pen text-secondary fs-20"></i>
                            </a>
                            <a class="pading-action" href="{{ route('product.delete', $product-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-20"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $products->links('pagination::bootstrap-4') }}
</div>