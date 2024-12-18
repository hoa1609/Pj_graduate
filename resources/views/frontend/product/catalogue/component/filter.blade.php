<div class="col-lg-2">
    @if(isset($filters))
        @foreach ($filters as $val)
        @php
            $catName = $val->languages->first()->pivot->name;
        @endphp
            <div class="filter-item">
                <div class="filter-heading">{{ $catName }}</div>
                @foreach ($val->attributes as $item)
                    @php
                        $attributeName = $item->languages->first()->pivot->name;
                        $id = $item->id;
                    @endphp
                    <div class="filter-body">
                        <div class="filter-choose">
                            <input 
                                type="checkbox" 
                                id="attribute-{{ $id }}" 
                                class="input-checkbox filtering filterAttribute"
                                value="{{ $id }}"
                                data-group="{{ $val->id }}"
                            >
                            <label>{{ $attributeName }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
    <!--- --->
    <div class="ec-sidebar-block pt-3">
        <div class="ec-sb-title">
            <h3 class="ec-sidebar-title">Giá</h3>
        </div>
        <div class="ec-sb-block-content es-price-slider">
            <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
            <div class="filtering uk-flex uk-space-between">
                <input type="text" id="min_price" class="price-range-field" >
                <input type="text" id="max_price" class="price-range-field" >
            </div>
        </div>
    </div>
    <input type="hidden" class="product_catalogue_id" value="{{ $productCatalogue->id }}">
</div>