@extends('layout.master')
@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Chi tiết</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="{{route('homepage')}}">Trang chủ</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Chi tiết</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start main Content -->
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="wn__single__product">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="wn__fotorama__wrapper">
                                    <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                        {{--Cannot use object of type Kreait\Firebase\Database\Query as array (View: C:\xampp\htdocs\www\BookStore\resources\views\page\detail.blade.php)--}}
                                        <a href="http://demo.devitems.com/boighor-v2/1.jpg"><img src="{{@$detail['detail_image']}}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1>{{@$detail['title']}}</h1>
                                    <div class="product-reviews-summary d-flex">
                                        <ul class="rating-summary d-flex">
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                        </ul>
                                    </div>
                                    <p>{{@$detail['author']}}</p>
                                    <div class="price-box">
                                        <span>{{@$detail['final_price']}}</span>
                                    </div>
                                    <form action="{{ route('addtocart', $detail['book_id']) }}" accept-charset="UTF-8" method="post">
                                        <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                        <div class="box-tocart d-flex">
                                                <span>Số lượng</span>
                                                <input id="qty" class="input-text qty" name="quantity" min="1" value="1" title="Qty" type="number">
                                                <div class="addtocart__actions">
                                                    <button class="tocart" type="submit" title="Add to Cart">Chọn mua</button>
                                                </div>
                                                <div class="product-addto-links clearfix">
                                                    <a class="wishlist" href="@if(Session::has('token') && Session::get('login') == true) {{ route('addlike', $detail['book_id']) }} @else {{ route('login') }} @endif"></a>
                                                    <a class="compare" href="#"></a>
                                                </div>
                                        </div>
                                    </form>
                                    <div class="product_meta">
											<span class="posted_in">Categories:
												<a href="single-product.php#">Adventure</a>,
												<a href="single-product.php#">Kids' Music</a>
											</span>
                                    </div>
                                    <div class="product-share">
                                        <ul>
                                            <li class="categories-title">Share :</li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-twitter icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-tumblr icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-facebook icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-linkedin icons"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__info__detailed">
                        <div class="pro_details_nav nav justify-content-start" role="tablist">
                            <a class="nav-item nav-link active showDetail" data-toggle="tab" href="single-product.php#nav-details" role="tab">Chi tiết</a>
                            <a class="nav-item nav-link showComment" data-toggle="tab" href="single-product.php#nav-review" role="tab">Đánh giá</a>

                        </div>
                        <div class="tab__container">
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                <div class="description__attribute">
                                    {!! $detail['detail'] !!}
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
                                <div class="review__attribute">
                                    <h1>Customer Reviews</h1>
                                    <h2>Hastech</h2>
                                    <div class="review__ratings__type d-flex">
                                        <div class="review-ratings">
                                            <div class="rating-summary d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>

                                            <div class="rating-summary d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="rating-summary d-flex">
                                                <span>value</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <p>Hastech</p>
                                            <p>Review by Hastech</p>
                                            <p>Posted on 11/6/2018</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-fieldset">
                                    <h2>You're reviewing:</h2>
                                    <h3>Chaz Kangeroo Hoodie</h3>
                                    <div class="review-field-ratings">
                                        <div class="product-review-table">
                                            <div class="review-field-rating d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Value</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form_field">
                                        <div class="input__box">
                                            <span>Nickname</span>
                                            <input id="nickname_field" type="text" name="nickname">
                                        </div>
                                        <div class="input__box">
                                            <span>Summary</span>
                                            <input id="summery_field" type="text" name="summery">
                                        </div>
                                        <div class="input__box">
                                            <span>Review</span>
                                            <textarea name="review"></textarea>
                                        </div>
                                        <div class="review-form-actions">
                                            <button>Submit Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                        </div>
                        <div class="hidden">
                            Comment:
                            <input type="text">
                            <button type="submit">Comment</button>
                        </div>
                    </div>
                    <div class="wn__related__product pt--80 pb--50">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">Sản phẩm liên quan</h2>
                        </div>
                        <div class="row mt--60">
                            <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                @foreach($all_book as $key => $all)
                                    <!-- Start Single Product -->
                                        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                            <div class="product__thumb">
                                                <a class="first__img" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                                                <a class="second__img animation1" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                                                <div class="hot__box">
                                                    <span class="hot-label">BEST SALLER</span>
                                                </div>
                                            </div>
                                            <div class="product__content content--center">
                                                <h4><a href="{{route('detail', $all['book_id'])}}">{{@$all['title']}}</a></h4>
                                                <ul class="prize d-flex">
                                                    <li>{{@$all['final_price']}}</li>
                                                    <li class="old_prize">{{@$all['price_regular']}}</li>
                                                </ul>
                                                <div class="action">
                                                    <div class="actions_inner">
                                                        <ul class="add_to_links">
                                                            <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                                                            <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                            <li><a class="compare" href="single-product.php#"><i class="bi bi-heart-beat"></i></a></li>
                                                            <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="single-product.php#productmodal"><i class="bi bi-search"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product__hover--content">
                                                    <ul class="rating d-flex">
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Start Single Product -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="wn__related__product">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">Sản phẩm đã xem</h2>
                        </div>
                        <div class="row mt--60">
                            <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                @foreach($all_book as $key => $all)
                                    @if($key%2==0)
                                        <!-- Start Single Product -->
                                            <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                                <div class="product__thumb">
                                                    <a class="first__img" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                                                    <a class="second__img animation1" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                                                    <div class="hot__box">
                                                        <span class="hot-label">BEST SALLER</span>
                                                    </div>
                                                </div>
                                                <div class="product__content content--center">
                                                    <h4><a href="{{route('detail', $all['book_id'])}}">{{@$all['title']}}</a></h4>
                                                    <ul class="prize d-flex">
                                                        <li>{{@$all['final_price']}}</li>
                                                        <li class="old_prize">{{@$all['price_regular']}}</li>
                                                    </ul>
                                                    <div class="action">
                                                        <div class="actions_inner">
                                                            <ul class="add_to_links">
                                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                                                                <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                                <li><a class="compare" href="single-product.php#"><i class="bi bi-heart-beat"></i></a></li>
                                                                <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="single-product.php#productmodal"><i class="bi bi-search"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__hover--content">
                                                        <ul class="rating d-flex">
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Single Product -->
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Product Categories</h3>
                            <ul>
                                <li><a href="single-product.php#">Biography <span>(3)</span></a></li>
                                <li><a href="single-product.php#">Business <span>(4)</span></a></li>
                                <li><a href="single-product.php#">Cookbooks <span>(6)</span></a></li>
                                <li><a href="single-product.php#">Health & Fitness <span>(7)</span></a></li>
                                <li><a href="single-product.php#">History <span>(8)</span></a></li>
                                <li><a href="single-product.php#">Mystery <span>(9)</span></a></li>
                                <li><a href="single-product.php#">Inspiration <span>(13)</span></a></li>
                                <li><a href="single-product.php#">Romance <span>(20)</span></a></li>
                                <li><a href="single-product.php#">Fiction/Fantasy <span>(22)</span></a></li>
                                <li><a href="single-product.php#">Self-Improvement <span>(13)</span></a></li>
                                <li><a href="single-product.php#">Humor Books <span>(17)</span></a></li>
                                <li><a href="single-product.php#">Harry Potter <span>(20)</span></a></li>
                                <li><a href="single-product.php#">Land of Stories <span>(34)</span></a></li>
                                <li><a href="single-product.php#">Kids' Music <span>(60)</span></a></li>
                                <li><a href="single-product.php#">Toys & Games <span>(3)</span></a></li>
                                <li><a href="single-product.php#">hoodies <span>(3)</span></a></li>
                            </ul>
                        </aside>
                        <aside class="wedget__categories pro--range">
                            <h3 class="wedget__title">Filter by price</h3>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="single-product.php#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price :</span><input type="text" id="amount" readonly="">
                                                </div>
                                                <div class="price--filter">
                                                    <a href="single-product.php#">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </aside>
                        <aside class="wedget__categories poroduct--compare">
                            <h3 class="wedget__title">Compare</h3>
                            <ul>
                                <li><a href="single-product.php#">x</a><a href="single-product.php#">Condimentum posuere</a></li>
                                <li><a href="single-product.php#">x</a><a href="single-product.php#">Condimentum posuere</a></li>
                                <li><a href="single-product.php#">x</a><a href="single-product.php#">Dignissim venenatis</a></li>
                            </ul>
                        </aside>
                        <aside class="wedget__categories poroduct--tag">
                            <h3 class="wedget__title">Product Tags</h3>
                            <ul>
                                <li><a href="single-product.php#">Biography</a></li>
                                <li><a href="single-product.php#">Business</a></li>
                                <li><a href="single-product.php#">Cookbooks</a></li>
                                <li><a href="single-product.php#">Health & Fitness</a></li>
                                <li><a href="single-product.php#">History</a></li>
                                <li><a href="single-product.php#">Mystery</a></li>
                                <li><a href="single-product.php#">Inspiration</a></li>
                                <li><a href="single-product.php#">Religion</a></li>
                                <li><a href="single-product.php#">Fiction</a></li>
                                <li><a href="single-product.php#">Fantasy</a></li>
                                <li><a href="single-product.php#">Music</a></li>
                                <li><a href="single-product.php#">Toys</a></li>
                                <li><a href="single-product.php#">Hoodies</a></li>
                            </ul>
                        </aside>
                        <aside class="wedget__categories sidebar--banner">
                            <img src="images/others/banner_left.jpg" alt="banner images">
                            <div class="text">
                                <h2>new products</h2>
                                <h6>save up to <br> <strong>40%</strong>off</h6>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End main Content -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form--2" class="minisearch" action="single-product.php#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="single-product.php#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->
@endsection


