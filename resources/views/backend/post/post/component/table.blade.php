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
                {{-- <th>Vị trí</th> --}}
                <th>Tình trạng</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td style="width: 16px;">
                            <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $post-> id }}">                                                    
                        </td>
                        <td><img loading="lazy" src="{{ $post-> image}}" alt="image" height="60px"></td>
                        <td>
                            <div class="uk-flex flex-direction-column">
                                <div class="fsz-5 text-overflow">{{ $post->name }}</div>
                                <div class="uk-flex">
                                    <div class="category">
                                        <span class="color-note">Nhóm hiển thị: </span>
                                    </div>
                                    <div class="text-danger">
                                        @foreach ($post-> post_catalogues as $val)
                                            @foreach ($val-> post_catalogue_language as $cat)
                                                <a href="{{ route('post.index', ['post_catalogue_id' => $val-> id]) }}">{{ $cat-> name }} |</a>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <input type="text" name="form-control" data-id="{{ $post->id }}" data-model="{{ $config['model'] }}" value="{{ $post-> order }}">
                        </td> --}}
                        <td>
                            <div class="form-switch">
                                <input class="form-check-input status js-switch-{{ $post-> id }}" 
                                    type="checkbox" 
                                    data-field="publish" 
                                    data-model="{{ $config['model'] }}" 
                                    value="{{ $post->publish }}"  
                                    data-modeId="{{ $post->id }}"
                                    {{ $post->publish == 2 ? 'checked' : '' }} 
                                    >
                            </div>
                        </td>
                        <td class="text-end uk-flex uk-flex-middle hight-85">                                                        
                            <a class="pading-action" href="{{ route('post.edit', $post-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <form action="{{ route('post.destroy', $post-> id) }}" method="POST">
                                @method('DELETE')
                                @csrf  
                                <input 
                                    type="hidden"
                                    name="name"
                                    value="{{ old('name', ($post->name) ?? '' ) }}"
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
    {{  $posts->links('pagination::bootstrap-4') }}
</div>