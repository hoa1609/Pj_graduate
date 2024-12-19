@php
    $bannerLazy = App\Enums\SlideEnum::BANNERLAZY;
@endphp
@if(isset($slides[$bannerLazy]))
    <section class="section ec-product-tab section-space-p">
        @foreach ($slides[$bannerLazy]['item'] as $val)
            @php
                $image = $val['image'];
                $canonical = ($val['canonical']);
            @endphp
            <div class="container" data-animation="fadeIn">
                <a href="{{ $canonical }}">
                    <img src="{{ $image }}" alt="bannerLazy">
                </a>
            </div>
        @endforeach
    </section>
@endif