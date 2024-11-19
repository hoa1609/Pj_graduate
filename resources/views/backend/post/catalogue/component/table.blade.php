<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Tên nhóm</th>

                @foreach($languages as $language)
                            @if(session('app_locale') === $language->canonical)
                                @continue; 
                             @endif
                    <th class="text-center"><span class="image img-scaledown laguange-flag"><img src="{{ $language->image}}" alt="" style="width:40px;"></span></th>
                @endforeach

                <th>Tình trạng</th>
                <th class="text-end">Thao tác</th>
            </tr>
            </thead>
            {{-- @php dd(session('app_locale')) @endphp --}}
            <tbody>
                @foreach ($postCatalogues as $postCatalogue)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $postCatalogue-> id }}">                                                    
                        </th>
                        <td>{{ str_repeat('|----', (($postCatalogue-> level >0) ?($postCatalogue-> level - 1) : 0)).$postCatalogue-> name }}</td>
                        
                        @include('backend.dashboard.component.languageTd', ['model' => $postCatalogue, 'modeling' => 'PostCatalogue']);
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $postCatalogue-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="PostCatalogue" 
                                    value="{{ $postCatalogue->publish }}"  
                                    data-modeId="{{ $postCatalogue->id }}"
                                    {{ $postCatalogue->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end">                                                        
                            <a class="pading-action" href="{{ route('post.catalogue.edit', $postCatalogue-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('post.catalogue.delete', $postCatalogue-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $postCatalogues->links('pagination::bootstrap-4') }}
</div>