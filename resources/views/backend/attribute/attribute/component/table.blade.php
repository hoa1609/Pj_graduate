<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered">
            <thead class="table-light">
            <tr>
                <th style="width: 16px;">
                    <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">                                                    
                </th>
                <th>Bài viết</th>
                <th>Hình ảnh</th>
                {{-- <th>Vị trí</th> --}}
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($attributes as $attribute)
                    <tr>
                        <th style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $attribute-> id }}">                                                    
                        </th>
                        <th><img loading="lazy" src="{{ $attribute-> image}}" alt="image" width="50px"></th>
                        <td>
                            <div class="uk-flex flex-direction-column">
                                <div class="fsz-5">{{ $attribute->name }}</div>
                                <div class="uk-flex">
                                    <div class="category">
                                        <span class="color-note">Nhóm hiển thị: </span>
                                    </div>
                                    <div class="text-danger">
                                        @foreach ($attribute-> attribute_catalogues as $val)
                                            @foreach ($val-> attribute_catalogue_language as $cat)
                                                <a href="{{ route('attribute.index', ['attribute_catalogue_id' => $val-> id]) }}">{{ $cat-> name }} |</a>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <input type="text" name="form-control" data-id="{{ $attribute->id }}" data-model="{{ $config['model'] }}" value="{{ $attribute-> order }}">
                        </td> --}}
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $attribute-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="{{ $config['model'] }}" 
                                    value="{{ $attribute->publish }}"  
                                    data-modeId="{{ $attribute->id }}"
                                    {{ $attribute->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end uk-flex">                                                        
                            <a class="pading-action" href="{{ route('attribute.edit', $attribute-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('attribute.destroy', $attribute-> id) }}" method="POST">
                                @method('DELETE')
                                @csrf  
                                <input 
                                    type="hidden"
                                    name="name"
                                    value="{{ old('name', ($attribute->name) ?? '' ) }}"
                                    class="form-control"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                >
                                <button class="button_none pading-action" style="submit"><i class="las la-trash-alt text-secondary fs-18"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $attributes->links('pagination::bootstrap-4') }}
</div>