@extends('frontend.homepage.layout')
@section('content')
    <div class="section-fixed-top">  
        <div class="container pt-5 pb-5">
            <div class="uk-flex uk-content-center border">
                <div class="col-md-4 box-find">
                    <div class="title-tracking-header">
                        <h3>Theo dõi đơn hàng</h3>
                    </div>
                    <form action="{{ route('find.result') }}" method="POST">
                        @csrf
                        <div class="form-group uk-flex">
                            <input type="text" name="code" class="form-control" placeholder="Nhập mã đơn hàng..." style="border-radius: 0">
                            <button type="submit" class="btn-tracking">Tra cứu</button>
                        </div>
                        @if ($errors->has('code')) 
                            <label class="err-message">*
                                    {{$errors->first('code') }}
                            </label>    
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
