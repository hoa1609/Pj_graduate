@php
    $slideKeyword = App\Enums\SlideEnum::MAIN;
@endphp
<div class="ec-main-slider section section-space-pb">
    @if(!is_null($slides[$slideKeyword]['item']))
        <div class="container">
            <div class="panel-slide" data-setting="{{ json_encode($slides[$slideKeyword]['setting']) }}">
                <div class="swiper-container main-slider-dot">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        @foreach ($slides[$slideKeyword]['item'] as $key => $val)
                        @php
                            $name = $val['name'];
                            $image = $val['image'];
                            $description = $val['description'];
                            $canonical = $val['canonical'];
                            $alt = $val['alt'];
                            $window = $val['window'];
                        @endphp
                            <div class="swiper-slide">
                                <div class="container-center">
                                    <div class="item-center slider-animation">
                                        <h2 class="title-slide">{{ $name }}</h2>
                                        <h1 class="description-slide">{{ $description }}</h1>   
                                        <div class="item-button">
                                            @if(!is_null($canonical))
                                                <a href="{{ $canonical }}" class="btn btn-slide btn-primary">Mua ngay 
                                                    <i class="ecicon eci-angle-double-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <img class="image-slide" src="{{ $image }}" alt="{{ $alt }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    @endif
</div>  