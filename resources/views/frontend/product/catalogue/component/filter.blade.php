<div class="col-lg-2">
    @if(isset($filters))
        @foreach ($filters as $val)
        @php
            $catName = $val->languages->first()->pivot->name;
        @endphp
            <div class="filter-item">
                <div class="filter-heading">{{ $catName }}</div>
                @if(isset($val->attribute))
                    @foreach ($val->attribute as $item)
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
                @endif
            </div>
        @endforeach
    @endif
    <!--- --->
    <div class="ec-sidebar-block pt-3">
        <div class="ec-sb-title">
            <h3 class="filter-heading">Giá</h3>
        </div>
        <div class="ec-sb-block-content es-price-slider">
            <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
            <div class="filtering uk-flex uk-space-between item-range-filter">
                <input type="text" id="min_price" class="price-range-field mr-5">
                <input type="text" id="max_price" class="price-range-field text-end">
            </div>
        </div>
    </div>
    <input type="hidden" class="product_catalogue_id" value="{{ $productCatalogue->id }}">
</div>