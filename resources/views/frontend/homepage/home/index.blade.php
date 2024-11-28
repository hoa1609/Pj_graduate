@extends('frontend.homepage.layout')
@section('content')
      @include('frontend.homepage.home.component.slide')
      @include('frontend.homepage.home.component.productcatelogue')
      @include('frontend.homepage.home.component.otherproduct')
      @include('frontend.homepage.home.component.dealofday')

      <section class="section ec-product-tab section-space-p">
          <div class="container">
            <div class="col-lg-12 col-md-12">
                <div class="row space-t-50">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="ec-title">New Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row margin-minus-b-15">
                    <div class="col">
                        <div class="tab-content">
                           {{-- test review san pham --}}
                            <div class="tab-pane fade show active" id="all">
                                <div class="row">
                                    
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="product-left-sidebar.html" class="image">
                                                        <img class="main-image"
                                                            src="frontend/assets/images/product-image/88_1.jpg" alt="Product" />
                                                        <img class="hover-image"
                                                            src="frontend/assets/images/product-image/4_2.jpg" alt="Product" />
                                                    </a>
                                                    <span class="percentage">20%</span>
                                                    <div class="ec-pro-actions">
                                                        <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                                        <a href="#" class="ec-btn-group quickview" data-link-action="quickview" title="Quick view"
                                                            data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i class="fi-rr-eye"></i></a>
                                                        <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
                                                        <a href="javascript:void(0)"  title="Add To Cart" class="ec-btn-group add-to-cart"><i class="fi-rr-shopping-basket"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">T-Shirt</h6></a> 
                                                <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Relaxed Short full Sleeve T-Shirt</a></h5>
                                                <div class="ec-pro-rat-price">
                                                    <span class="ec-pro-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star"></i>
                                                        <i class="ecicon eci-star"></i>
                                                    </span>
                                                    <span class="ec-price">
                                                        <span class="new-price">$58.00</span>
                                                        <span class="old-price">$65.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </section>
      
      @include('frontend.homepage.home.component.information')
      @include('frontend.homepage.home.component.blog')
      @include('frontend.homepage.home.component.quickview')
@endsection