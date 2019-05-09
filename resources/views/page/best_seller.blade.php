<!-- Start Best Seller Area -->
<section class="best-seel-area pt--80 pb--60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                </div>
            </div>
        </div>
    </div>
    <div class="slider center">
    @foreach($all_book as $key => $all)
        <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    <a class="first__img" href="{{route('detail', $all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                </div>
                <div class="product__content content--center">
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
            <!-- Single product end -->
        @endforeach
    </div>
</section>
<!-- End Best Seller Area -->