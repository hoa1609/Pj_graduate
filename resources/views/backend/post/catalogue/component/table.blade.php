<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Hình ảnh</th>
                <th>Tên ngôn ngữ</th>
                <th>Canonical</th>
                <th>Mô tả</th>
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($postCatalogues as $postCatalogue)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $postCatalogue-> id }}">                                                    
                        </th>
                        <td> <img src="{{ $postCatalogue-> image }}" alt="flag" style="max-width: 60px"></td>
                        <td> {{ $postCatalogue-> name }}</td>
                        <td> {{ $postCatalogue-> canonical }}</td>
                        <td> {{ $postCatalogue-> description }}</td>
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
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('post.catalogue.edit', $postCatalogue-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('post.catalogue.destroy', $postCatalogue-> id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="button_none pading-action" style="submit"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{-- {{  $postCatalogue->links('pagination::bootstrap-4') }} --}}
</div>