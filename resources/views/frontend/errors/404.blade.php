@extends('frontend.homepage.layout')
@section('content')
    <div class="section-fixed-top">  
        <div class="container pt-5 pb-5">
            <div class="uk-flex uk-content-center">
                <div class="text-center">
                    <img src="frontend/assets/images/error/404_page.webp" alt="404" width="280px" height="280">
                    <h2 class="header-error">Trang này không tồn tại</h2>
                    <span>Vui lòng kiểm tra đường dẫn của bạn hoặc quay về trang chủ 4AM Style</span> 
                    <div class="pt-5">
                        <a href="{{ route('home.index') }}" class="btn btn-dark border-10">Quay về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
