<footer class="ec-footer">
    <div class="footer-container">
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 ec-footer-cont-social">
                        <div class="ec-footer-contact">
                            <div class="ec-footer-widget">
                                <div class="mb-4">
                                    <img src="{{ $system['homepage_logo'] }}" alt="Site Logo" style="width: 80px" />
                                </div>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link ec-foo-location"><span><i class="fi fi-rr-marker"></i></span>
                                            <p>{{ $system['contact_office'] }}</p>
                                        </li>
                                        <li class="ec-footer-link ec-foo-call"><span><i class="fi-rr-phone-call"></i></span>
                                            <a href="{{ $system['contact_hotline'] }}">{{ $system['contact_hotline'] }}</a>
                                        </li>
                                        <li class="ec-footer-link ec-foo-mail"><span>
                                            <i class="fi fi-rr-envelope"></i></span>
                                            <a href="{{ $system['contact_email'] }}">{{ $system['contact_email'] }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($menu['footer-menu']) && !is_null($menu['footer-menu']))
                        @foreach ($menu['footer-menu'] as $key => $val)
                            @php
                                $header = $val['item']->languages->first()->pivot->name;
                            @endphp
                            <div class="col-sm-12 col-lg-3 ec-footer-account">
                                <div class="ec-footer-widget">
                                    <h4 class="ec-footer-heading">{{ $header }}</h4>
                                    <div class="ec-footer-links">
                                        <ul class="align-items-center">
                                            @if(isset($val['children']) && !is_null($val['children']))
                                                @foreach ($val['children'] as $children)
                                                    @php
                                                        $chilName = $children['item']->languages->first()->pivot->name;
                                                        $chilCananical = $children['item']->languages->first()->pivot->name;
                                                    @endphp
                                                    <li class="ec-footer-link"><a href="{{ $chilCananical }}">{{ $chilName }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @if(isset($menu['category-footer']) && !is_null($menu['category-footer']))
                <div class="container box-footer-cate">
                    <div class="header-footer">Danh mục sản phẩm</div>
                    <div class="row">
                        @foreach ($menu['category-footer'] as $key => $val)
                            @php
                                $category = $val['item']->languages->first()->pivot->name;
                            @endphp
                            <div class="col-md-3 ec-footer-account">
                                <h4 class="footer-heading-cate">{{ $category }}</h4>
                                <div class="ec-footer-links">
                                    <ul class="footer-list">
                                        @if(isset($val['children']) && !is_null($val['children']))
                                        @foreach ($val['children'] as $children)
                                            @php
                                                $chilName = $children['item']->languages->first()->pivot->name;
                                                $chilCananical = $children['item']->languages->first()->pivot->name;
                                            @endphp
                                            <li><a href="{{ $chilCananical }}">{{ $chilName }}</a></li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">@ Bản quyền thuộc về 
                                <a href="{{ route('home.index') }}"><strong>4AM Style</strong></a>
                                 All right reserved
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>