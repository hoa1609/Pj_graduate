<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Tên nhóm</th>
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($productCatalogues as $productCatalogue)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $productCatalogue-> id }}">                                                    
                        </th>
                        <td>{{ str_repeat('|----', (($productCatalogue-> level >0) ?($productCatalogue-> level - 1) : 0)).$productCatalogue-> name }}</td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $productCatalogue-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="ProductCatalogue" 
                                    value="{{ $productCatalogue->publish }}"  
                                    data-modeId="{{ $productCatalogue->id }}"
                                    {{ $productCatalogue->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td>                                                        
                            <a class="pading-action" href="{{ route('product.catalogue.edit', $productCatalogue-> id) }}">
                                <i class="las la-pen text-secondary fs-20"></i>
                            </a>
                            <a class="pading-action" href="{{ route('product.catalogue.delete', $productCatalogue-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-20"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $productCatalogues->links('pagination::bootstrap-4') }}
</div>