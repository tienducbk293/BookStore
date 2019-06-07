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
        <div class="tab__container mt--60">
            <!-- Start Single Tab Content -->
            <div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
                <div class="product__indicator--4 arrows_style owl-carousel owl-theme">
                    @foreach($all_book as $key => $all)
                        <div class="single__product">
                            <!-- Start Single Product -->
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="product product__style--3">
                                    <div class="product__thumb">
                                        <a class="first__img" href="{{ route('detail', $all['book_id']) }}"><img src="{{@$all['image']}}" alt="product image"></a>
                                        <div class="hot__box">
                                            <span class="hot-label">HOT</span>
                                        </div>
                                    </div>
                                    <div class="product__content content--center content--center">
                                        <h4><a href="{{route('detail', @$all['book_id'])}}">{{@$all['title']}}</a></h4>
                                        <ul class="prize d-flex">
                                            <li>{{@$all['final_price']}}</li>
                                            <li class="old_prize">{{@$all['price_regular']}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Single Product -->
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End Single Tab Content -->

        </div>
    </div>
</section>
<!-- Start All Products Area -->