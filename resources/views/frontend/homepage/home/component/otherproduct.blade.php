@if(!is_null($widgets['other-product']))
    @foreach ($widgets['other-product']->object as $category)
        @php
            $catName = $category->languages->first()->pivot->name;
            $catCanonical = write_url($category->languages->first()->pivot->canonical, true, true);
            $childrens = ($category->childrens) ?? null ;
        @endphp
        <section class="section ec-product-tab section-space-p">
            <div class="container">
                <div class="col-lg-12 col-md-12">
                   <!------danh muc san pham------->
                    @if(!is_null($childrens) && isset($childrens))
                        <div class="row space-t-50">
                            <div class="uk-flex uk-space-between px-2">
                                <div class="section-title">
                                    <h2 class="ec-title">{{ $catName }}</h2>
                                </div>
                                <div class="ec-pro-tab">
                                    <ul class="ec-pro-tab-nav nav justify-content-end">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="{{ $catCanonical }}">Tất cả</a></li>
                                        @foreach ($childrens as $children)
                                            @php
                                                $chilName = $children->languages->first()->pivot->name;
                                                $chilCanonical = write_url($children->languages->first()->pivot->canonical, true, true);
                                            @endphp
                                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="{{ $chilCanonical }}">{{ $chilName }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                   <!------san pham--->
                    @if(isset($category->products) && count($category->products))
                        <div class="row margin-minus-b-15">
                            <div class="col">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="all">
                                        <div class="row">
                                            @foreach ($category->products as $product)
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                                    @include('frontend.component.product-item')
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach
@endif