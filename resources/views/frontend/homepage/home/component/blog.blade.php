@if(isset($widgets['blog']) && !is_null($widgets['blog']))
    <section class="section ec-blog-section section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="ec-title">Tin tức</h2>
                    </div>
                </div>
                <div class="ec-blog-slider owl-carousel" data-animation="fadeIn">
                    @foreach ($widgets['blog']->object as $key => $val)
                        @php
                            $blogName = $val->languages->first()->pivot->name;
                            $blogImage = $val->image;
                            $blogDate = $val->created_at;
                            $blogCanonical = write_url($val->languages->first()->pivot->canonical, true, true);
                            /*------------*/
                            $cateBlog = $val->post_catalogues->first()->languages->first()->pivot->name;
                            $cateCanonical = write_url($val->post_catalogues->first()->languages->first()->pivot->canonical, true, true);
                        @endphp
                        <div class="ec-blog-block">
                            <div class="ec-blog-inner">
                                <div class="ec-blog-image">
                                    <a href="{{ $blogCanonical }}">
                                        <img class="blog-image" src="{{ $blogImage }}" alt="Blog" />
                                    </a>
                                </div>
                                <div class="ec-blog-content">
                                    <div class="ec-blog-cat"><a href="{{ $cateCanonical }}">{{ $cateBlog }}</a></div>
                                    <h5 class="ec-blog-title"><a href="{{ $blogCanonical }}">{{ $blogName }}</a></h5>
                                    {{-- <div class="ec-blog-date">{{ convertDateTime($blogDate) }}</div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
