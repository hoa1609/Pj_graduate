@php
    $attributeQueryString = explode(',', request()->get('attribute_id'));
@endphp
@if(!is_null($attributeCatalogue))
    @foreach ($attributeCatalogue as $key =>$val)
        <div class="ec-pro-variation">
            <div class="ec-pro-variation-inner variant-item">
                <label class="capitalize-star mb-2">
                    {{ $val->name }}:
                    <span></span>
                </label>
                @if (!is_null($val->attributes))
                    <div class="ec-pro-variation-content attribute-value uk-flex">
                        @foreach ($val->attributes as $keyAttr => $attr)
                        @php
                            $isActive = (is_array($attributeQueryString) && in_array($attr->id, $attributeQueryString)) || ($keyAttr == 0 && !empty($attributeQueryString));
                        @endphp

                            @if($attr->image != null)
                                <a class="item--color 
                                    {{ $isActive ? 'active' : '' }}" 
                                    data-attributeid="{{ $attr->id }}" 
                                    title="{{ $attr->name }}"
                                    >
                                    <img src="{{ $attr->image }}" alt="{{ $attr->name }}" class="attribute-image-round">
                                </a>
                            @else
                                <div class="item--other 
                                    {{ $isActive ? 'active' : '' }}" 
                                    data-attributeid="{{ $attr->id }}" 
                                    title="{{ $attr->name }}"
                                    >
                                    {{ $attr->name }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endif
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="language_id" value="{{ $config['language'] }}">