<!-- Start All Products Area -->
<section class="wn__bestseller__area bg--white pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">Tất cả <span class="color--theme">sản phẩm</span></h2>
                    <p>Tất cả các cuốn sách ở nhiều thể loại khác nhau, đến từ các nhà xuất bản uy tín và được chắp bút bởi các tác giả tài năng và nổi tiếng</p>
                </div>
            </div>
        </div>
        <div class="row mt--50">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="product__nav nav justify-content-center" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="index.html#nav-all" role="tab">ALL</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="index.html#nav-biographic" role="tab">BIOGRAPHIC</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="index.html#nav-adventure" role="tab">ADVENTURE</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="index.html#nav-children" role="tab">CHILDREN</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="index.html#nav-cook" role="tab">COOK</a>
                </div>
            </div>
        </div>
        <div class="tab__container mt--60">
            <!-- Start Single Tab Content -->
            <div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
                <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                    @foreach($all_book as $key => $all)
                        @if($key%2==0)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="#"><img src="{{@$all_book[$key]['image']}}" alt="product image"></a>
                                            <div class="hot__box">
                                                <span class="hot-label">HOT</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{route('detail', @$all['book_id'])}}">{{@$all_book[$key]['title']}}</a></h4>
                                            <ul class="prize d-flex">
                                                <li>{{@$all_book[$key]['final_price']}}</li>
                                                <li class="old_prize">{{@$all_book[$key]['price_regular']}}</li>
                                            </ul>
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
                                </div>
                                <!-- Start Single Product -->
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                    @foreach($all_book as $key => $all)
                        @if($key%2==1)
                            <div class="single__product">
                                <!-- Start Single Product -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="product product__style--3">
                                        <div class="product__thumb">
                                            <a class="first__img" href="#"><img src="{{@$all_book[$key]['image']}}" alt="product image"></a>
                                            <a class="second__img animation1" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all_book[$key]['image']}}" alt="product image"></a>
                                            <div class="hot__box">
                                                <span class="hot-label">HOT</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center content--center">
                                            <h4><a href="{{route('detail', $all['book_id'])}}">{{@$all_book[$key]['title']}}</a></h4>
                                            <ul class="prize d-flex">
                                                <li>{{@$all_book[$key]['final_price']}}</li>
                                                <li class="old_prize">{{@$all_book[$key]['price_regular']}}</li>
                                            </ul>
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
                                </div>
                                <!-- Start Single Product -->
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- End Single Tab Content -->

        </div>
    </div>
</section>
<!-- Start All Products Area -->