@php
    $bannerSeller = App\Enums\SlideEnum::SELLER;
@endphp
<section class="section ec-product-tab section-space-p">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="ec-title">sản phẩm bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-15">
                <div class="col">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="" style="width: 420px">
                                        @foreach ($slides[$bannerSeller]['item'] as $val)
                                            @php
                                                $image = $val['image'];
                                                $canonical = ($val['canonical']);
                                            @endphp
                                            <a href="{{ $canonical }}">
                                                <img src="{{ $image }}" alt="slide">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row uk-flex">
                                        <div class="title-header pl-0">
                                            <h3>"Chất lượng vương tầm"</h3>
                                        </div>
                                        <div class="description pl-0">
                                            <p>
                                                "Sản phẩm bán chạy nhờ thiết kế tinh tế, chất lượng vượt trội, giá cả hợp lý, đáp ứng mọi nhu cầu. Lựa chọn hoàn hảo cho mọi khách hàng, mang đến sự hài lòng và trải nghiệm tuyệt vời mỗi ngày!"
                                            </p>
                                        </div>
                                        <div class="title-seeding pl-0 pb-1">
                                            <a href="">
                                                Xem thêm <i class="fa-solid fa-arrow-right"></i>  
                                            </a>
                                        </div>
                                        <div class="row ec-blog-slider owl-carousel">
                                            @foreach ($widgets['best-seller']->object as $key => $val)
                                                @include('frontend.component.product-item', ['product' => $val])
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>