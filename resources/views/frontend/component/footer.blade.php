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
                            $catf = $val['item']->languages->first()->pivot->name;
                        @endphp
                            <div class="col-sm-12 col-lg-3 ec-footer-account">
                                <div class="ec-footer-widget">
                                    <h4 class="ec-footer-heading">{{ $catf }}</h4>
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
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">{{ $system['homepage_copyright'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>