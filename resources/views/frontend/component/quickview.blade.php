<div class="modal fade" id="ec_quickview_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="product-popup">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-3 gallery-container">
                        <div class="qty-nav-thumb">
                            <!-- ***album**** -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 gallery-container ps-0">
                        <div class="qty-product-cover zoom-image-hover">
                            <!-- ***album**** -->
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12 ps-5">
                        <div class="quickview-pro-content pb-1">
                            <h5 class="ec-quick-title product-main-title product-name"></h5>
                            <div class="ec-quickview-rating uk-flex uk-align-center">
                                <div class="sku info me-3">
                                    <span id="sku-text"></span>
                                    <i class="fa-regular fa-copy" id="copy-sku"></i>
                                </div>
                                <div class="item-star">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star"></i>
                                </div>
                            </div>
                            <div class="item-price-detail">
                                <span class="ec-price">
                                    <span class="new-price text-danger"></span>
                                </span>
                            </div>
                            <div id="attribute-container">
                                <!-- **variant attributer** -->
                            </div>
                            
                            <div class="ec-quickview-qty">
                                <div class="qty-plus-minus">
                                    <input class="qty-input" type="text" name="ec_qtybtn" value="1">
                                </div>
                                <div class="ec-quickview-cart addToCart" data-id="">
                                    <button class="btn btn-danger">Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                        @include('frontend.product.product.component.methodproduct')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
