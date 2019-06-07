<!-- Start Best Seller Area -->
<section class="best-seel-area pt--80 pb--60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
                    <p>Những cuốn sách được liệt kê vào danh sách best seller của cửa hàng, với nội dung hấp dẫn và khuyến mại lớn</p>
                </div>
            </div>
        </div>
    </div>
    <div class="slider center">
    @foreach($all_book as $key => $all)
        <!-- Single product start -->
            <div class="product product__style--3">
                <div class="product__thumb">
                    <a class="first__img" href="{{route('detail', @$all['book_id'])}}"><img src="{{@$all['image']}}" alt="product image"></a>
                </div>
            </div>
            <!-- Single product end -->
        @endforeach
    </div>
</section>
<!-- End Best Seller Area -->