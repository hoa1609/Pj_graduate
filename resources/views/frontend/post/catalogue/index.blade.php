@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.breadcrumb', ['breadcrumb' => $breadcrumb])
    <section class="ec-page-content">
        <div class="container">
            @if(!is_null($posts))
                <div class="shop-pro-content section-space-p">
                    <div class="ec-blogs-inner">
                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-md-4 col-sm-12 mb-6 ec-blog-block">
                                    @php
                                        $name = $post->languages->first()->pivot->name;
                                        $description = $post->languages->first()->pivot->description;
                                        $canonical = write_url($post->languages->first()->pivot->canonical, true, true);
                                        $image = image($post->image);
                                        $catName = $post->post_catalogues->first()->languages->first()->pivot->name;
                                    @endphp
                                    <div class="ec-blog-inner">
                                        <div class="">
                                            <a href="{{ $canonical }}">
                                                <img class="blog-image" src="{{ $image }}" alt="Blog" />
                                            </a>
                                        </div>
                                        <div class="ec-blog-content">
                                            <h5 class="ec-blog-title">
                                                <a href="{{ $canonical }}">{{ $name }}</a>
                                            </h5>
                                            <div class="ec-blog-desc">{!! $description !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="uk-flex uk-flex-center">
                            @include('frontend.component.pagination', ['model' => $posts])
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
