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
                @foreach ($languages as $language)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $language-> id }}">                                                    
                        </th>
                        <td> <img src="{{ $language-> image }}" alt="flag" style="max-width: 60px"></td>
                        <td> {{ $language-> name }}</td>
                        <td> {{ $language-> canonical }}</td>
                        <td> {{ $language-> description }}</td>
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $language-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="Language" 
                                    value="{{ $language->publish }}"  
                                    data-modeId="{{ $language->id }}"
                                    {{ $language->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('language.edit', $language-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('language.destroy', $language-> id) }}" method="POST">
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
    {{-- {{  $language->links('pagination::bootstrap-4') }} --}}
</div>