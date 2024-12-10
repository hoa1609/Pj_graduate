@if(isset($productRelation) && count($productRelation))
    <section class="section ec-product-tab section-space-p mb-3">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="row space-t-50">
                    <div class="uk-flex uk-space-between px-2">
                        <div class="section-title">
                            <h2 class="ec-title">Sản phẩm tương tự</h2>
                        </div>
                    </div>
                </div>
                <div class="row margin-minus-b-15">
                    <div class="col">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="all">
                                <div class="row">
                                    @foreach ($productRelation as $relation)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                            @include('frontend.component.product-item',['product' => $relation])
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
