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
                    @foreach ($val->attributes as $attr)
                        <a class="choose-attribute" data-attributeid="{{ $attr->id }}" title="{{ $attr->name }}">{{ $attr->name }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    @endforeach
@endif
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="language_id" value="{{ $config['language'] }}">