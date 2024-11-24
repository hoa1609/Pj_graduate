@if(!is_null($attributeCatalogue))
    @foreach ($attributeCatalogue as $key =>$val)
        <div class="ec-pro-variation">
            <div class="ec-pro-variation-inner variant-item">
                <label>
                    {{ $val->name }}:
                    <span></span>
                </label>
                @if (!is_null($val->attributes))
                <div class="ec-pro-variation-content">
                    @foreach ($val->attributes as $attr)
                        <a class="choose-attribute" data-attributeid="{{ $attr->id }}" title="{{ $attr->name }}">{{ $attr->name }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    @endforeach
@endif