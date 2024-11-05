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
                @foreach ($attributeCatalogues as $attributeCatalogue)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $attributeCatalogue-> id }}">                                                    
                        </th>
                        <td>{{ str_repeat('|----', (($attributeCatalogue-> level >0) ?($attributeCatalogue-> level - 1) : 0)).$attributeCatalogue-> name }}</td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $attributeCatalogue-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="AttributeCatalogue" 
                                    value="{{ $attributeCatalogue->publish }}"  
                                    data-modeId="{{ $attributeCatalogue->id }}"
                                    {{ $attributeCatalogue->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td>                                                        
                            <a class="pading-action" href="{{ route('attribute.catalogue.edit', $attributeCatalogue-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('attribute.catalogue.delete', $attributeCatalogue-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $attributeCatalogues->links('pagination::bootstrap-4') }}
</div>