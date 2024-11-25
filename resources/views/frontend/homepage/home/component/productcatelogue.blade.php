<section class="section ec-product-tab section-space-p">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <section class="section ec-category-section section-space-p">
                <div class="container">
                    @if(!is_null($widgets['category']))
                        <div class="row margin-minus-b-15 margin-minus-t-15">
                            <div id="ec-cat-slider" class="ec-cat-slider owl-carousel">
                                @foreach ($widgets['category']->object as $key => $val)
                                    @php
                                        $name = $val->languages->first()->pivot->name;
                                        $image = $val->image;
                                        $productCount = $val->products_count;
                                        $canonical = write_url($val->languages->first()->pivot->canonical);
                                    @endphp

                                    <div class="ec_cat_content ec_cat_content_8">
                                        <div class="ec_cat_inner ec_cat_inner-8">
                                            <div class="ec-category-image">
                                                <img src="{{ $image }}" class="svg_img" alt="drink" />
                                            </div>
                                            <div class="ec-category-desc">
                                                <h3>{{ $name }}
                                                    <span title="Category Items">( {{ $productCount }} )</span>
                                                </h3>
                                                <a href="{{ $canonical }}" class="cat-show-all">Tất cả <i class="ecicon eci-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</section>