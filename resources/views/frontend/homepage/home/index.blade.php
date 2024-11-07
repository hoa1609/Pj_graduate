@extends('frontend.homepage.layout')
@section('content')
      <!-- Ekka Cart Start -->
      <div class="ec-side-cart-overlay"></div>
      <div id="ec-side-cart" class="ec-side-cart">
          <div class="ec-cart-inner">
              <div class="ec-cart-top">
                  <div class="ec-cart-title">
                      <span class="cart_title">My Cart</span>
                      <button class="ec-close">×</button>
                  </div>
                  <ul class="eccart-pro-items">
                      <li>
                          <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                  src="assets/images/product-image/93_1.jpg" alt="product"></a>
                          <div class="ec-pro-content">
                              <a href="single-product-left-sidebar.html" class="cart_pro_title">Mens Winter Leathers Jackets</a>
                              <span class="cart-price"><span>$49.00</span> x 1</span>
                              <div class="qty-plus-minus">
                                  <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                              </div>
                              <a href="#" class="remove">×</a>
                          </div>
                      </li>
                      <li>
                          <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                  src="assets/images/product-image/96_1.jpg" alt="product"></a>
                          <div class="ec-pro-content">
                              <a href="product-left-sidebar.html" class="cart_pro_title">Running & Trekking Shoes - White</a>
                              <span class="cart-price"><span>$150.00</span> x 1</span>
                              <div class="qty-plus-minus">
                                  <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                              </div>
                              <a href="#" class="remove">×</a>
                          </div>
                      </li>
                      <li>
                          <a href="product-left-sidebar.html" class="sidecart_pro_img"><img
                                  src="assets/images/product-image/111_1.jpg" alt="product"></a>
                          <div class="ec-pro-content">
                              <a href="product-left-sidebar.html" class="cart_pro_title">Rose Gold Peacock Earrings</a>
                              <span class="cart-price"><span>$950.00</span> x 1</span>
                              <div class="qty-plus-minus">
                                  <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                              </div>
                              <a href="#" class="remove">×</a>
                          </div>
                      </li>
                  </ul>
              </div>
              <div class="ec-cart-bottom">
                  <div class="cart-sub-total">
                      <table class="table cart-table">
                          <tbody>
                              <tr>
                                  <td class="text-left">Sub-Total :</td>
                                  <td class="text-right">$300.00</td>
                              </tr>
                              <tr>
                                  <td class="text-left">VAT (20%) :</td>
                                  <td class="text-right">$60.00</td>
                              </tr>
                              <tr>
                                  <td class="text-left">Total :</td>
                                  <td class="text-right primary-color">$360.00</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="cart_btn">
                      <a href="cart.html" class="btn btn-primary">View Cart</a>
                      <a href="checkout.html" class="btn btn-secondary">Checkout</a>
                  </div>
              </div>
          </div>
      </div>
      <!-- Ekka Cart End -->
  
      @include('frontend.component.slide')
  
      <!--  category Section Start -->
      <section class="section ec-category-section section-space-p">
          <div class="container">
              <div class="row d-none">
                  <div class="col-md-12">
                      <div class="section-title">
                          <h2 class="ec-title">Top Category</h2>
                      </div>
                  </div>
              </div>
              <div class="row margin-minus-b-15 margin-minus-t-15">
                  <div id="ec-cat-slider" class="ec-cat-slider owl-carousel">
                  <div class="ec_cat_content ec_cat_content_1">
                      <div class="ec_cat_inner ec_cat_inner-1">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/dress-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>dress & frock <span title="Category Items">(53)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_2">
                      <div class="ec_cat_inner ec_cat_inner-2">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/coat-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>Winter wear <span title="Category Items">(58)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_3">
                      <div class="ec_cat_inner ec_cat_inner-3">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/glasses-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>glasses & lens <span title="Category Items">(76)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_4">
                      <div class="ec_cat_inner ec_cat_inner-4">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/shorts-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>shorts & jeans<span title="Category Items">(49)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_5">
                      <div class="ec_cat_inner ec_cat_inner-5">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/t-shirt-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>T-shirts<span title="Category Items">(25)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_6">
                      <div class="ec_cat_inner ec_cat_inner-6">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/jacket-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>jacket<span title="Category Items">(35)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_7">
                      <div class="ec_cat_inner ec_cat_inner-7">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/watch-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>watch<span title="Category Items">(89)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="ec_cat_content ec_cat_content_8">
                      <div class="ec_cat_inner ec_cat_inner-8">
                          <div class="ec-category-image">
                              <img src="assets/images/icons/hat-cat-8.png" class="svg_img" alt="drink" />
                          </div>
                          <div class="ec-category-desc">
                              <h3>hat & caps <span title="Category Items">(65)</span></h3>
                              <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"
                                      aria-hidden="true"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
      </section>
      <!--category Section End -->
      
      <!-- Product tab Area Start -->
      <section class="section ec-product-tab section-space-p">
          <div class="container">
              <div class="row">
  
                  <!-- Sidebar area start -->
                 
  
                  <!-- Product area start -->
                  <div class="col-lg-9 col-md-12">
   
                      <!-- ec New Arrivals, ec Trending, ec Top Rated Start -->
                      <div class="row">
                          <!-- ec New Arrivals -->
                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content margin-b-30" data-animation="fadeIn">
                              <div class="col-md-12">
                                  <div class="section-title">
                                      <h2 class="ec-title">New Arrivals</h2>
                                  </div>
                              </div>
                              <div class="ec-new-slider">
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/88_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Relaxed Short full Sleeve T-Shirt</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">clothes</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$50.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 2 pack</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/89_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Girls pnk Embro design Top</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Clothes</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$62.00</span>
                                                          <span class="old-price">$65.00</span>
                                                          <span class="qty">- 1 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/90_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Black Floral Wrap Midi Skirt</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Clothes</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$52.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 1 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/91_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Pure Garment Dyed Cotton Shirt</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Mens fashion</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$56.00</span>
                                                          <span class="old-price">$78.00</span>
                                                          <span class="qty">- 3 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/92_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">MEN Yarn Fleece Full-Zip Jacket</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">winter wear</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$10.00</span>
                                                          <span class="old-price">$11.00</span>
                                                          <span class="qty">- 500 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/93_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Mens Winter Leathers Jackets</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Winter wear</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$42.00</span>
                                                          <span class="old-price">$45.00</span>
                                                          <span class="qty">- 5 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/94_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Mens Winter Leathers Jackets</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">jackets</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$25.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 250 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/95_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Better Basics French Terry Sweatshorts</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">shorts</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$20.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 12 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- ec Trending -->
                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content margin-b-30" data-animation="fadeIn">
                              <div class="col-md-12">
                                  <div class="section-title">
                                      <h2 class="ec-title">Trending</h2>
                                  </div>
                              </div>
                              <div class="ec-new-slider">
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/96_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Running & Trekking Shoes - White</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">sports</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$42.00</span>
                                                          <span class="old-price">$45.00</span>
                                                          <span class="qty">- 5 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/97_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Trekking & Running Shoes - black</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Sports</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$25.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 250 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/98_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Womens Party Wear Shoes</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">party wear</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$62.00</span>
                                                          <span class="old-price">$65.00</span>
                                                          <span class="qty">- 1 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/99_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Sports Claw Women's Shoes</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">sports</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$10.00</span>
                                                          <span class="old-price">$11.00</span>
                                                          <span class="qty">- 500 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/100_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Air Trekking Shoes - white</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">sports</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$52.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 1 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/101_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Boot With Suede Detail</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">boots</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$20.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 12 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/102_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Men's Leather Formal Wear shoes</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">formal</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$56.00</span>
                                                          <span class="old-price">$78.00</span>
                                                          <span class="qty">- 3 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/103_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Casual Men's Brown shoes</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Casual</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$50.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 2 pack</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- ec Top Rated -->
                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-6 ec-all-product-content ec-new-product-content m-auto" data-animation="fadeIn">
                              <div class="col-md-12">
                                  <div class="section-title">
                                      <h2 class="ec-title">Top Rated</h2>
                                  </div>
                              </div>
                              <div class="ec-new-slider">
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/112_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">platinum Zircon Classic Ring</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">jewellery</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$62.00</span>
                                                          <span class="old-price">$65.00</span>
                                                          <span class="qty">- 1 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/105_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Smart watche Vital Plus</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">Watches</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$56.00</span>
                                                          <span class="old-price">$78.00</span>
                                                          <span class="qty">- 3 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/110_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">shampoo conditioner packs</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">cosmetics</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$25.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 250 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/111_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Rose Gold Peacock Earrings</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">jewellery</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$20.00</span>
                                                          <span class="old-price">$30.00</span>
                                                          <span class="qty">- 12 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/106_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Pocket Watch Leather Pouch</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">watches</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$50.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 2 pack</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/107_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Silver Deer Heart Necklace</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">jewellery</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$52.00</span>
                                                          <span class="old-price">$55.00</span>
                                                          <span class="qty">- 1 pcs</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/108_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Titan 100 Ml Womens Perfume</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">perfume</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$10.00</span>
                                                          <span class="old-price">$11.00</span>
                                                          <span class="qty">- 500 g</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-12 ec-all-product-block">
                                      <div class="ec-all-product-inner">
                                          <div class="ec-pro-image-outer">
                                              <div class="ec-pro-image">
                                                  <a href="product-left-sidebar.html" class="image">
                                                      <img class="main-image" src="assets/images/product-image/109_1.jpg"
                                                          alt="Product" />
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="ec-pro-content">
                                              <h5 class="ec-pro-title"><a href="product-left-sidebar.html">men's Leather Reversible Belt</a></h5>
                                              <h6 class="ec-pro-stitle"><a href="shop-left-sidebar-col-3.html">belts</a></h6>
                                              <div class="ec-pro-rat-price">
                                                  <div class="ec-pro-rat-pri-inner">
                                                      <span class="ec-price">
                                                          <span class="new-price">$42.00</span>
                                                          <span class="old-price">$45.00</span>
                                                          <span class="qty">- 5 kg</span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- ec New Arrivals, ec Trending, ec Top Rated end -->
  
                      <!-- Deal of the day Start -->
                      <div class="row space-t-50" data-animation="fadeIn">
                          <!--  Special Section Start -->
                          <div class="ec-spe-section col-lg-12 col-md-12 col-sm-12 sectopn-spc-mb">
                              <div class="col-md-12">
                                  <div class="section-title">
                                      <h2 class="ec-title">Deal of the day</h2>
                                  </div>
                              </div>
  
                              <div class="ec-spe-products">
                                  <div class="ec-spe-product">
                                      <div class="ec-spe-pro-inner">
                                          <div class="ec-spe-pro-image-outer col-md-6 col-sm-12">
                                              <div class="ec-spe-pro-image">
                                                  <img class="img-responsive" src="assets/images/product-image/111_1.jpg" alt="">                                                                              
                                              </div>
                                          </div>
                                          <div class="ec-spe-pro-content col-md-6 col-sm-12">
                                              <div class="ec-spe-pro-rating">
                                                  <span class="ec-spe-rating-icon">
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star"></i>
                                                      <i class="ecicon eci-star"></i>
                                                  </span>
                                              </div>
                                              <h5 class="ec-spe-pro-title"><a href="product-left-sidebar.html">Rose Gold diamonds Earring</a></h5>
                                              <div class="ec-spe-pro-desc">Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                  dolor dolor sit amet consectetur Lorem ipsum dolor</div>
                                              <div class="ec-spe-price">
                                                  <span class="new-price">$1990.00</span>
                                                  <span class="old-price">$2000.00</span>
                                              </div>
                                              <div class="ec-spe-pro-btn">
                                                  <a href="#" class="btn btn-lg btn-primary">Add To Cart</a>
                                              </div>
                                              <div class="ec-spe-pro-progress">
                                                  <span class="ec-spe-pro-progress-desc"><span>Already Sold:
                                                          <b>15</b></span><span>Available: <b>40</b></span></span>
                                                  <span class="ec-spe-pro-progressbar"></span>
                                              </div>
                                              <div class="countdowntimer">
                                                  <span class="ec-spe-count-desc"> Hurry Up! Offer ends in:</span>
                                                  <span id="ec-spe-count-1"></span>
                                              </div>
  
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ec-spe-product">
                                      <div class="ec-spe-pro-inner">
                                          <div class="ec-spe-pro-image-outer col-md-6 col-sm-12">
                                              <div class="ec-spe-pro-image">
                                                  <img class="img-responsive"
                                                              src="assets/images/product-image/110_1.jpg" alt="">
                                              </div>
                                          </div>
                                          <div class="ec-spe-pro-content col-md-6 col-sm-12">
                                              <div class="ec-spe-pro-rating">
                                                  <span class="ec-spe-rating-icon">
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star fill"></i>
                                                      <i class="ecicon eci-star"></i>
                                                      <i class="ecicon eci-star"></i>
                                                  </span>
                                              </div>
                                              <h5 class="ec-spe-pro-title"><a href="product-left-sidebar.html">shampoo, conditioner & facewash packs</a></h5>
                                              <div class="ec-spe-pro-desc">Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                                  dolor dolor sit amet consectetur Lorem ipsum dolor</div>
                                              <div class="ec-spe-price">
                                                  <span class="new-price">$150.00</span>
                                                  <span class="old-price">$200.00</span>
                                              </div>
                                              <div class="ec-spe-pro-btn">
                                                  <a href="#" class="btn btn-lg btn-primary">Add To Cart</a>
                                              </div>
                                              <div class="ec-spe-pro-progress">
                                                  <span class="ec-spe-pro-progress-desc"><span>Already Sold:
                                                          <b>20</b></span><span>Available: <b>40</b></span></span>
                                                  <span class="ec-spe-pro-progressbar"></span>
                                              </div>
                                              <div class="countdowntimer">
                                                  <span class="ec-spe-count-desc"> Hurry Up! Offer ends in:</span>
                                                  <span id="ec-spe-count-2"></span>
                                              </div>
  
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!--  Special Section End -->
                      </div>
                      <!-- Deal of the day end -->
  
                      <!-- Product tab area start -->
                      <div class="row space-t-50">
                          <div class="col-md-12">
                              <div class="section-title">
                                  <h2 class="ec-title">New Products</h2>
                              </div>
                          </div>
  
                          <!-- Tab Start -->
                          <div class="col-md-12 ec-pro-tab">
                              <ul class="ec-pro-tab-nav nav justify-content-end">
                                  <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                          href="#all">All</a></li>
                                  <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#clothes">Clothes</a></li>
                                  <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                          href="#footwear">Footwear</a></li>
                                  <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                              href="#accessories">accessories</a></li>
                              </ul>
                          </div>
                          <!-- Tab End -->
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
                                                                  src="assets/images/product-image/88_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/88_1.jpg" alt="Product" />
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
                                  <!-- ec 1st Product tab end -->
                                  <!-- ec 2nd Product tab start -->
                                  <div class="tab-pane fade" id="clothes">
                                      <div class="row">
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/94_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/94_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Jackets</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Mens Winter Leathers Jackets</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$59.00</span>
                                                              <span class="old-price">$87.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/95_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/95_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Shorts</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Better Basics French Terry Sweatshorts</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$78.00</span>
                                                              <span class="old-price">$85.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/88_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/88_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/89_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/89_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">top</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Girls pnk Embro design Top</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$45.00</span>
                                                              <span class="old-price">$50.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/90_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/90_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Skirt</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Black Floral Wrap Midi Skirt</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$25.00</span>
                                                              <span class="old-price">$35.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/91_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/91_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Shirt</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Pure Garment Dyed Cotton Shirt</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$45.00</span>
                                                              <span class="old-price">$56.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/92_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/92_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Jacket</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">MEN Yarn Fleece Full-Zip Jacket</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$49.00</span>
                                                              <span class="old-price">$65.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/93_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/93_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Jacket</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Mens Winter Leathers Jackets</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$32.00</span>
                                                              <span class="old-price">$45.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- ec 2nd Product tab end -->
                                  <!-- ec 3rd Product tab start -->
                                  <div class="tab-pane fade" id="footwear">
                                      <div class="row">
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/96_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/96_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Sports</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Running & Trekking Shoes - White</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$89.00</span>
                                                              <span class="old-price">$95.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/97_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/97_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Sports</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Trekking & Running Shoes - black</a></h5>
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
                                                              <span class="old-price">$64.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/98_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/98_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">party wear</h6></a> 
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Womens Party Wear Shoes</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$25.00</span>
                                                              <span class="old-price">$30.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/99_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/99_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Sports</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Sports Claw Women's Shoes</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$50.00</span>
                                                              <span class="old-price">$70.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/100_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/100_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Sports</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Air Trekking Shoes - white</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$62.00</span>
                                                              <span class="old-price">$80.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/104_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/104_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Boots</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Boot With Suede Detail</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$65.00</span>
                                                              <span class="old-price">$70.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/102_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/102_1.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Formal</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Men's Leather Formal Wear shoes</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$50.00</span>
                                                              <span class="old-price">$65.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/103_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/103_1.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Casual</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Casual Men's Brown shoes</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$99.00</span>
                                                              <span class="old-price">$105.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- ec 3rd Product tab end -->
                                  <!-- ec 3rd Product tab start -->
                                  <div class="tab-pane fade" id="accessories">
                                      <div class="row">
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/105_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/105_2.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">watches</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Smart watche Vital Plus</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$100.00</span>
                                                              <span class="old-price">$120.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/106_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/106_2.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Watches</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Pocket Watch Leather Pouch</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$150.00</span>
                                                              <span class="old-price">$170.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/107_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/107_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">jewellery</h6></a> 
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Silver Deer Heart Necklace</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$650.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/108_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/108_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Perfume</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Titan 100 Ml Womens Perfume</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$20.00</span>
                                                              <span class="old-price">$21.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/109_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/109_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="new">New</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">Belt</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">men's Leather Reversible Belt</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$25.00</span>
                                                              <span class="old-price">$35.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/110_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/110_1.jpg" alt="Product" />
                                                          </a>
                                                          <span class="flags">
                                                              <span class="sale">Sale</span>
                                                          </span>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">cosmetics</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">shampoo conditioner packs</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$50.00</span>
                                                              <span class="old-price">$60.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/111_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/111_1.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">jewellery</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Rose Gold Peacock Earrings</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$10.00</span>
                                                              <span class="old-price">$12.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                              <div class="ec-product-inner">
                                                  <div class="ec-pro-image-outer">
                                                      <div class="ec-pro-image">
                                                          <a href="product-left-sidebar.html" class="image">
                                                              <img class="main-image"
                                                                  src="assets/images/product-image/112_1.jpg" alt="Product" />
                                                              <img class="hover-image"
                                                                  src="assets/images/product-image/112_1.jpg" alt="Product" />
                                                          </a>
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
                                                      <a href="shop-left-sidebar-col-3.html"><h6 class="ec-pro-stitle">jewellery</h6></a>
                                                      <h5 class="ec-pro-title"><a href="product-left-sidebar.html">platinum Zircon Classic Ring</a></h5>
                                                      <div class="ec-pro-rat-price">
                                                          <span class="ec-pro-rating">
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star fill"></i>
                                                              <i class="ecicon eci-star"></i>
                                                          </span>
                                                          <span class="ec-price">
                                                              <span class="new-price">$850.00</span>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- ec 3rd Product tab end -->
                              </div>
                          </div>
                      </div>
                      <!-- Product tab area end -->
  
                  </div>
              </div>
          </div>
      </section>
      <!-- ec Product tab Area End -->
  
      <!--  Testimonial, Banner & Service Section Start -->
      <section class="section ec-ser-spe-section section-space-p">
          <div class="container" data-animation="fadeIn">
              <div class="row">
                  <!-- ec Testimonial Start -->
                  <div class="ec-test-section col-lg-3 col-md-6 col-sm-12 col-xs-6 sectopn-spc-mb" data-animation="slideInRight">
                      <div class="col-md-12">
                          <div class="section-title">
                              <h2 class="ec-title">Testimonial</h2>
                          </div>
                      </div>
                      <div class="ec-test-outer">
                          <ul id="ec-testimonial-slider">
                              <li class="ec-test-item">
                                  <div class="ec-test-inner">
                                      <div class="ec-test-img">
                                          <img alt="testimonial" title="testimonial"
                                              src="assets/images/testimonial/1.jpg" />
                                      </div>
                                      <div class="ec-test-content">
                                          <div class="ec-test-name">mark jofferson</div>
                                          <div class="ec-test-designation">- CEO & Founder Invision</div>
                                          <div class="ec-test-divider">
                                              <i class="fi-rr-quote-right"></i>
                                          </div>
                                          <div class="ec-test-desc">Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                              dolor dolor sit amet.
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="ec-test-item">
                                  <div class="ec-test-inner">
                                      <div class="ec-test-img">
                                          <img alt="testimonial" title="testimonial"
                                              src="assets/images/testimonial/2.jpg" />
                                      </div>
                                      <div class="ec-test-content">
                                          <div class="ec-test-name">mark jofferson</div>
                                          <div class="ec-test-designation">- CEO & Founder Invision</div>
                                          <div class="ec-test-divider">
                                              <i class="fi-rr-quote-right"></i>
                                          </div>
                                          <div class="ec-test-desc">Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                              dolor dolor sit amet.
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="ec-test-item">
                                  <div class="ec-test-inner">
                                      <div class="ec-test-img">
                                          <img alt="testimonial" title="testimonial"
                                              src="assets/images/testimonial/3.jpg" />
                                      </div>
                                      <div class="ec-test-content">
                                          <div class="ec-test-name">mark jofferson</div>
                                          <div class="ec-test-designation">- CEO & Founder Invision</div>
                                          <div class="ec-test-divider">
                                              <i class="fi-rr-quote-right"></i>
                                          </div>
                                          <div class="ec-test-desc">Lorem ipsum dolor sit amet consectetur Lorem ipsum
                                              dolor dolor sit amet.
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <!-- ec Testimonial end -->
                  <!-- ec Banner Start -->
                  <div class="col-md-6 col-sm-12" data-animation="fadeIn">
                      <div class="ec-banner-inner">
                          <div class="ec-banner-block ec-banner-block-1">
                              <div class="banner-block">
                                  <div class="banner-content">
                                      <div class="banner-text">
                                          <span class="ec-banner-disc">25% discount</span>
                                          <span class="ec-banner-title">Fashion & cosmetics</span>
                                          <span class="ec-banner-stitle">Starting @ $10</span>
                                      </div>
                                      <span class="ec-banner-btn"><a href="shop-left-sidebar-col-3.html">Shop Now <i
                                                  class="ecicon eci-angle-double-right" aria-hidden="true"></i></a></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- ec Banner End -->
                  <!--  Service Section Start -->
                  <div class="ec-services-section col-lg-3 col-md-3 col-sm-3" data-animation="slideInLeft">
                      <div class="col-md-12">
                          <div class="section-title">
                              <h2 class="ec-title">Our Services</h2>
                          </div>
                      </div>
                      <div class="ec_ser_block">
                          <div class="ec_ser_content ec_ser_content_1 col-sm-12">
                              <div class="ec_ser_inner">
                                  <div class="ec-service-image">
                                      <i class="fi fi-ts-truck-moving"></i>
                                  </div>
                                  <div class="ec-service-desc">
                                      <h2>Worldwide Delivery</h2>
                                      <p>For Order Over $100</p>
                                  </div>
                              </div>
                          </div>
                          <div class="ec_ser_content ec_ser_content_2 col-sm-12">
                              <div class="ec_ser_inner">
                                  <div class="ec-service-image">
                                      <i class="fi fi-ts-tachometer-fast"></i>
                                  </div>
                                  <div class="ec-service-desc">
                                      <h2>Next Day delivery</h2>
                                      <p>UK Orders Only</p>
                                  </div>
                              </div>
                          </div>
                          <div class="ec_ser_content ec_ser_content_3 col-sm-12">
                              <div class="ec_ser_inner">
                                  <div class="ec-service-image">
                                      <i class="fi fi-ts-circle-phone"></i>
                                  </div>
                                  <div class="ec-service-desc">
                                      <h2>Best Online Support</h2>
                                      <p>Hours: 8AM -11PM</p>
                                  </div>
                              </div>
                          </div>
                          <div class="ec_ser_content ec_ser_content_4 col-sm-12">
                              <div class="ec_ser_inner">
                                  <div class="ec-service-image">
                                      <i class="fi fi-ts-badge-percent"></i>
                                  </div>
                                  <div class="ec-service-desc">
                                      <h2>Return Policy</h2>
                                      <p>Easy & Free Return</p>
                                  </div>
                              </div>
                          </div>
                          <div class="ec_ser_content ec_ser_content_5 col-sm-12">
                              <div class="ec_ser_inner">
                                  <div class="ec-service-image">
                                      <i class="fi fi-ts-donate"></i>
                                  </div>
                                  <div class="ec-service-desc">
                                      <h2>30% money back</h2>
                                      <p>For Order Over $100</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- ec Service End -->
              </div>
          </div>
      </section>
      <!--  End Testimonial, Banner & Service Section Start -->
  
      <!--  Blog Section Start -->
      <section class="section ec-blog-section section-space-p">
          <div class="container">
              <div class="row">
                  <div class="ec-blog-slider owl-carousel" data-animation="fadeIn">
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/2.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Clothes</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">Curbside fashion Trends: How to Win the Pickup Battle.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Robin</span> / Jan 18, 2022</div>
                              </div>
                          </div>
                      </div>
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/3.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Fashion</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">Clothes Retail KPIs 2021 Guide for Clothes Executives.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Admin</span> / Apr 06, 2022</div>
                              </div>
                          </div>
                      </div>
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/4.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Shoes</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">EBT vendors: Claim Your Share of SNAP Online Revenue.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Selsa</span> / Feb 10, 2022</div>
                              </div>
                          </div>
                      </div>
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/5.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Electronics</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">Curbside fashion Trends: How to Win the Pickup Battle.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Pawar</span> / Mar 15, 2022</div>
                              </div>
                          </div>
                      </div>
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/6.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Glasses</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">6 fashion Retail Industry Digital Strategies for 2021.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Natly</span> / Jun 02, 2022</div>
                              </div>
                          </div>
                      </div>
                      <div class="ec-blog-block">
                          <div class="ec-blog-inner">
                              <div class="ec-blog-image">
                                  <a href="blog-detail-left-sidebar.html">
                                      <img class="blog-image" src="assets/images/blog-image/7.jpg"
                                          alt="Blog" />
                                  </a>
                              </div>
                              <div class="ec-blog-content">
                                  <div class="ec-blog-cat"><a href="blog-left-sidebar.html">Jewellery</a></div>
                                  <h5 class="ec-blog-title"><a
                                          href="blog-detail-left-sidebar.html">Why Should be Concerned About Instacart Patents.</a></h5>
  
                                  <div class="ec-blog-date">By<span>Mr Admin</span> / Feb 10, 2022</div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!--  Blog Section End -->
  
      <!-- Ec Instagram Start -->
      <section class="section ec-instagram-section section-space-pt">
          <div class="container">
              <h2 class="d-none">Instagram</h2>
              <div class="ec-insta-wrapper" data-animation="fadeIn">
                  <div class="ec-insta-outer">
                      <div class="insta-auto">
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/1.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/2.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/3.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/4.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/5.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/6.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/7.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                          <div class="ec-insta-item">
                              <div class="ec-insta-inner">
                                  <a href="#" target="_blank"><img src="assets/images/instragram-image/3.jpg" alt="">
  
                                  </a>
                              </div>
                          </div>
                          <!-- instagram item -->
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Ec Instagram End -->
  
@endsection