@if(count($slides->item))
    <div class="ec-main-slider section section-space-pb">
        <div class="container">
            {{-- <div class="panel-slide" data-setting="{{ json_encode($slides->setting) }}"> --}}
            <div class="" >
                <div class="ec-slider swiper-container main-slider-dot">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        @foreach ($slides->item as $key => $slide)
                            @foreach ($slide as $val)
                                <div class="ec-slide-item swiper-slide d-flex">
                                    <div class="container align-self-center">
                                        <div class="row">
                                            <div class="col-sm-12 align-self-center">
                                                <div class="ec-slide-content slider-animation">
                                                    {{-- <h2 class="ec-slide-stitle">{{ $val['name'] }}</h2>
                                                    <h1 class="ec-slide-title">{{ $val['description'] }}</h1>    --}}
                                                    {{-- <div class="ec-slide-desc">
                                                        <p>starting at $ <b>29</b>.99</p>
                                                        <a href="#" class="btn btn-lg btn-primary">Shop Now 
                                                            <i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <img  src="{!! $val['image'] !!}" alt="" width="100%">
                                    </div>
                                </div>
                                
                            @endforeach
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-white"></div>
                </div>
            </div>
        </div>
    </div>  
@endif

