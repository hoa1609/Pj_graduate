@extends('frontend.homepage.layout')
@section('content')
    <section class="gioi-thieu mt-5 section-fixed-top">
        <div class="container">
            <div class="noi-dung-gioi-thieu">
                <div class="col-md-5" data-animation="slideInRight">
                    <div class="text-gioi-thieu">
                        <h2>Về Chúng Tôi</h2>
                        <p>4 AM Style là thương hiệu thời trang cao cấp với những thiết kế tinh tế, sang trọng và dễ dàng phù hợp với phong cách sống hiện đại. Chúng tôi cam kết mang lại sản phẩm chất lượng với giá cả hợp lý cho tất cả khách hàng.</p>
                        <p>Với một đội ngũ thiết kế tài năng, chúng tôi luôn cập nhật các xu hướng mới nhất, đảm bảo rằng mỗi sản phẩm từ 4 AM Style không chỉ đẹp mà còn bền vững theo thời gian.</p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="ec-intro-slider section section-space-pb">
                        @php
                            $slideKeyword = App\Enums\SlideEnum::INTRO;
                        @endphp
                        @if(isset($slides[$slideKeyword]['item']) && !is_null($slides[$slideKeyword]['item']))
                            <div class="container">
                                <div class="panel-slide" data-setting="{{ json_encode($slides[$slideKeyword]['setting']) }}">
                                    <div class="swiper-container main-slider-dot" style="height: 300px">
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
                </div>
            </div>
        </div>
        <div class="container">
            <div class="noi-dung-gioi-thieu">
                <div class="col-md-5">
                    <div class="ec-intro-slider section section-space-pb">
                        @php
                            $slideKeyword = App\Enums\SlideEnum::INTRO2;
                        @endphp
                        @if(isset($slides[$slideKeyword]['item']) && !is_null($slides[$slideKeyword]['item']))
                            <div class="container">
                                <div class="panel-slide" data-setting="{{ json_encode($slides[$slideKeyword]['setting']) }}">
                                    <div class="swiper-container" style="height: 300px">
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
                </div>
                <div class="col-md-7" data-animation="slideInLeft">
                    <div class="text-gioi-thieu">
                        <h2>Sổ Tay Văn Hóa</h2>
                        <p>4AM-Style mong muốn mang đến cho toàn bộ khách hàng trên khắp mọi miền tổ quốc Việt Nam những sản phẩm thời trang do chính tay người Việt làm ra. Không phân biệt tầng lớp, không phân biệt giàu nghèo, những khách hàng chưa bao giờ được trải nghiệm dịch vụ mua sắm vượt ngoài mong đợi, ai cũng sẽ được chào đón, tôn trọng khi đến với 4AM-Style. .</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.other.component.information')
@endsection
