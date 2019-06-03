<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
    <div class="shop__sidebar">
        <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title">Danh mục sản phẩm</h3>
            <ul>
                @foreach($categories as $key => $category)
                    <li><a href="{{ route('category', $category['slug']) }}">{{ $category['category_name'] }}</a></li>
                @endforeach
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