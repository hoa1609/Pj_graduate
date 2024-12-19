@if(isset($widgets['new-product']) && !is_null($widgets['new-product']))
    @php
        $name = $widgets['new-product']->name;
    @endphp
    <section class="section ec-product-tab section-space-p">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="row space-t-50">
                    <div class="uk-flex uk-space-between px-2">
                        <div class="section-title">
                            <h2 class="ec-title">{{ $name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row margin-minus-b-15" data-animation="fadeIn">
                    <div class="col">
                        <div class="tab-content">
                            <div class>
                                <div class="row">
                                    @foreach ($widgets['new-product']->object as $key => $val)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                            @include('frontend.component.product-item', ['product' => $val])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

