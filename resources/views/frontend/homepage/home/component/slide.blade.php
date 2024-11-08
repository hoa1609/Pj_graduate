@if(count($slides->item))
    <div class="ec-main-slider section section-space-pb">
        <div class="container">
            <div class="panel-slide" data-setting="{{ json_encode($slides->setting) }}">
                <div class="swiper-container main-slider-dot">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        @foreach ($slides->item as $key => $slide)
                            @foreach ($slide as $val)
                                <div class="swiper-slide">
                                    <div class="container-center">
                                        <div class="item-center slider-animation">
                                            <h2 class="title-slide">{{ $val['name'] }}</h2>
                                            <h1 class="description-slide">{{ $val['description'] }}</h1>   
                                            <div class="item-button">
                                                <a href="{{ $val['canonical'] }}" class="btn btn-slide btn-primary">Mua ngay 
                                                    <i class="ecicon eci-angle-double-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="image-slide" src="{!! $val['image'] !!}" alt="{{ $val['alt'] }}">
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>  
@endif