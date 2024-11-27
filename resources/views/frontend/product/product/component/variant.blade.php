@php
    $attributeQueryString = explode(',', request()->get('attribute_id'));
@endphp
@if(!is_null($attributeCatalogue))
    @foreach ($attributeCatalogue as $key =>$val)
        <div class="ec-pro-variation">
            <div class="ec-pro-variation-inner variant-item">
                <label class="capitalize-star">
                    {{ $val->name }}:
                    <span></span>
                </label>
                @if (!is_null($val->attributes))
                <div class="ec-pro-variation-content attribute-value">
                    @foreach ($val->attributes as $keyAttr => $attr)
                        @php
                            $isActive = (is_array($attributeQueryString) && in_array($attr->id, $attributeQueryString)) || ($keyAttr == 0 && !empty($attributeQueryString));
                        @endphp
                        <a class="choose-attribute {{ $isActive ? 'active' : '' }}" data-attributeid="{{ $attr->id }}" 
                            title="{{ $attr->name }}"
                            >
                            {{ $attr->name }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    @endforeach
@endif
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="language_id" value="{{ $config['language'] }}">