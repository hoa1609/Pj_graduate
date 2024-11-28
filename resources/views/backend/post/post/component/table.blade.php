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

                {{-- @include('backend.dashboard.component.languageTh'); --}}
                
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
                                <div class="uk-flex uk-baseline pt-1">
                                    <div class="category">
                                        <span class="note-tag">Tag: </span>
                                    </div>
                                    <div class="note-tag">
                                        @foreach ($post-> post_catalogues as $val)
                                            @foreach ($val-> post_catalogue_language as $cat)
                                                <a href="{{ route('post.index', ['post_catalogue_id' => $val-> id]) }}">{{ $cat-> name }} |</a>
                                            @endforeach

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>

                        @include('backend.dashboard.component.languageTd', ['model' => $post, 'modeling' => 'Post']);

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
                        <td class="text-end">                                                        
                            <a class="pading-action" href="{{ route('post.edit', $post-> id) }}">
                                <i class="las la-pen text-secondary fs-18"></i>
                            </a>
                            <a class="pading-action" href="{{ route('post.delete', $post-> id) }}">
                                <i class="las la-trash-alt text-secondary fs-18"></i>
                            </a>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>            
    {{  $posts->links('pagination::bootstrap-4') }}
</div>