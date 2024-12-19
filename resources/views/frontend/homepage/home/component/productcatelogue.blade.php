<section class="section ec-product-tab">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <section class="section ec-category-section section-space-p">
                <div class="container">
                    @if(isset($widgets['category']) && !is_null($widgets['category']))
                        <div class="row margin-minus-b-15 margin-minus-t-15">
                            <div id="ec-cat-slider" class="ec-cat-slider owl-carousel">
                                @foreach ($widgets['category']->object as $key => $val)
                                    @php
                                        $name = $val->languages->first()->pivot->name;
                                        $image = $val->image;
                                        $productCount = $val->products_count;
                                        $canonical = write_url($val->languages->first()->pivot->canonical, true, true);
                                    @endphp
                                    <a href="{{ $canonical }}">
                                        <div class="image-category">
                                            <img src="{{ $image }}" class="image-category-slide" alt="list-category">
                                            <div class="name text-center">
                                                {{ $name }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</section>