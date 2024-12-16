@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.breadcrumb')
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-8 col-md-12">
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">
                        @php
                            $name = $post->name;
                            $content = $post->content;
                            $date = coverDatetime($post->created_at);
                            $canonical = write_url($post->canonical, true , true);
                            $image = $post->image;
                            $catName = $post->post_catalogues->first()->name;
                            $description = $post->description;
                        @endphp

                        <div class="blog-isul">
                            <div class="ec-blog-main-img">
                                <img class="blog-image" src="{{ $image }}" alt="Blog" />
                            </div>
                            <div class="item-title-post uk-flex uk-content-center">
                                <div class="item-post">
                                    <h3>{{ $name }}</h3>
                                    <div class="date">
                                        <i class="fa-regular fa-calendar-days"></i> &ensp;<span>{{ $date }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-blog-detail">
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

