<!-- Start New Books Area -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">Sản phẩm <span class="color--theme">mới</span></h2>
                    <p>Những cuốn sách mới được lên kệ, là những sản phẩm mới nhất đến từ các nhà xuất bản ở thời điểm hiện tại</p>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->

        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
        @foreach($all_book as $key => $all)
            <!-- Start Single Product -->
                <div class="product product__style--3">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product__thumb">
                            <a class="first__img" href="#"><img src="{{@$all['image']}}" alt="product image"></a>
                            <a class="second__img animation1" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                            <div class="hot__box">
                                <span class="hot-label">SALE</span>
                            </div>
                        </div>
                        <div class="product__content content--center">
                            <h4><a href="{{route('detail', $all['book_id'])}}">{{@$all['title']}}</a></h4>
                            <ul class="prize d-flex">
                                <li>{{@$all['final_price']}}</li>
                                <li class="old_prize">{{@$all['price_regular']}}</li>
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
            @endforeach
        </div>

        <!-- End Single Tab Content -->
    </div>
</section>
<!-- End New Books Area -->