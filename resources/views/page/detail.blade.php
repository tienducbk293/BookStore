@extends('layouts.master')
@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--4">
        <div class="container-fluid">
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
    <div class="container-fluid">
        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="wn__single__product">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="wn__fotorama__wrapper">
                                        @if(isset($detail['reading-book']))
                                            <a href="#" data-toggle="modal" data-target="#myModal" class="book-review-btn"><img src="images/books/icon-doc-thu.png" alt=""></a>
                                        @endif
                                        <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                            {{--Cannot use object of type Kreait\Firebase\Database\Query as array (View: C:\xampp\htdocs\www\BookStore\resources\views\page\detail.blade.php)--}}
                                            <a href="{{ route('detail', $detail['book_id']) }}"><img src="{{@$detail['detail_image']}}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="product__info__main">
                                        <h1>{{@$detail['title']}}</h1>
                                        <div class="product-reviews-summary d-flex">
                                            <div class="stars-outer">
                                                @if($everage != 0 || $everage != null)
                                                    <?php
                                                    $starPercentage = ($everage/5)* 100;
                                                    $starPercentageRound = (round($starPercentage/10)*10);
                                                    ?>
                                                    <div class="stars-inner" style="width: {{ $starPercentage.'%' }}">
                                                        @else
                                                            <div class="stars-inner" style="width: 0">
                                                                @endif
                                                            </div>
                                                    </div>
                                            </div>
                                            <p>{{@$detail['author']}}</p>
                                            <div class="price-box">
                                                <span>{{@$detail['final_price']}}</span>
                                            </div>
                                            <form action="{{ route('addtocart', @$detail['book_id']) }}" accept-charset="UTF-8" method="post">
                                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                                <div class="box-tocart d-flex">
                                                    <span>Số lượng</span>
                                                    <input id="qty" class="input-text qty" name="quantity" min="1" value="1" title="Qty" type="number">
                                                    <div class="addtocart__actions">
                                                        <button class="tocart" type="submit" title="Add to Cart">Chọn mua</button>
                                                    </div>
                                                    <div class="product-addto-links clearfix">
                                                        <a class="wishlist" href="@if(Session::has('token') && Session::get('login') == true) {{ route('addlike', $detail['book_id']) }} @else {{ route('login') }} @endif"></a>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="product_meta">
                                                <?php
                                                $cates = explode("/", $detail['category']);
                                                $slug = explode("/", $detail['slug']);
                                                ?>
                                                <span class="posted_in">Danh mục:
                                                @foreach($cates as $key => $cate)
                                                        @if($key == count($cates)-1)
                                                            <a href="{{ route('category', $slug[$key]) }}">{{ $cate }}</a>
                                                        @else
                                                            <a href="{{ route('category', $slug[$key]) }}">{{ $cate }}</a>,
                                                        @endif
                                                    @endforeach
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
                                    <a class="nav-item nav-link active showDetail" data-toggle="tab" href="" role="tab">Chi tiết</a>
                                    <a class="nav-item nav-link showComment" data-toggle="tab" href="" role="tab">Bình luận</a>

                                </div>
                                <div class="tab__container">
                                    <!-- Start Single Tab Content -->
                                    <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                        <div class="description__attribute">
                                            {!! $detail['detail'] !!}
                                        </div>
                                    </div>
                                    <!-- End Single Tab Content -->
                                </div>

                                <div class="hidden" id="hidden">
                                    @include('page.comment', ['comments', 'detail'])
                                    <div class="add-comment">
                                        <h4>Thêm bình luận</h4>
                                        <form action="{{ route('comment', @$detail['book_id']) }}" method="post">
                                            <p>Đánh giá</p>
                                            <fieldset class="rating">
                                                <input type="radio" id="star5"  name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            </fieldset>
                                            <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" ></textarea>
                                                <input type="hidden" name="book_id" value="{{ @$detail['book_id'] }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success" value="Bình luận" id="submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="wn__related__product pt--80 pb--50">
                                <div class="section__title text-center">
                                    <h2 class="title__be--2">Sản phẩm liên quan</h2>
                                </div>
                                <div class="row mt--60">
                                    <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                    @foreach($category_books as $key => $category_book)
                                        <!-- Start Single Product -->
                                        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                            <div class="product__thumb">
                                                <a class="first__img" href="{{route('detail', $category_book[$key]['book_id'])}}"><img src="{{@$category_book[$key]['image']}}" alt="product image"></a>
                                                <a class="second__img animation1" href="{{route('detail', $category_book[$key]['book_id'])}}"><img src="{{@$category_book[$key]['image']}}" alt="product image"></a>
                                                <div class="hot__box">
                                                    <span class="hot-label">BEST SALLER</span>
                                                </div>
                                            </div>
                                            <div class="product__content content--center">
                                                <h4><a href="{{route('detail', $category_book[$key]['book_id'])}}">{{@$category_book[$key]['title']}}</a></h4>
                                                <ul class="prize d-flex">
                                                    <li>{{@$category_book[$key]['final_price']}}</li>
                                                    <li class="old_prize">{{@$category_book[$key]['price_regular']}}</li>
                                                </ul>
                                                <div class="action">
                                                    <div class="actions_inner">
                                                        <ul class="add_to_links">
                                                            <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                                                            <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                            <li><a class="compare" href="single-product.php#"><i class="bi bi-heart-beat"></i></a></li>
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
                            @if(session('seen_books'))
                                <div class="wn__related__product">
                                    <div class="section__title text-center">
                                        <h2 class="title__be--2">Sản phẩm đã xem</h2>
                                    </div>
                                    <div class="row mt--60">
                                        <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                            @foreach(session('seen_books') as $key => $seen_book)
                                            <!-- Start Single Product -->
                                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="product__thumb">
                                                        <a class="first__img" href="{{route('detail', $seen_book['book_id'])}}"><img src="{{@$seen_book['image']}}" alt="product image"></a>
                                                        <a class="second__img animation1" href="{{route('detail', $seen_book['book_id'])}}"><img src="{{@$seen_book['image']}}" alt="product image"></a>
                                                        <div class="hot__box">
                                                            <span class="hot-label">BEST SALLER</span>
                                                        </div>
                                                    </div>
                                                    <div class="product__content content--center">
                                                        <h4><a href="{{route('detail', $seen_book['book_id'])}}">{{@$seen_book['title']}}</a></h4>
                                                        <ul class="prize d-flex">
                                                            <li>{{@$seen_book['final_price']}}</li>
                                                            <li class="old_prize">{{@$seen_book['price_regular']}}</li>
                                                        </ul>
                                                        <div class="action">
                                                            <div class="actions_inner">
                                                                <ul class="add_to_links">
                                                                    <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                                                                    <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                                    <li><a class="compare" href="single-product.php#"><i class="bi bi-heart-beat"></i></a></li>
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
                            @endif
                        </div>
                        @include('page.list_category')
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
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ @$detail['title'] }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        @if(isset($detail['reading-book']))
                            <iframe class="reading-book" src="{{ $detail['reading-book'] }}" frameborder="0"></iframe>
                        @endif
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

