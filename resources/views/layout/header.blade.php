<!-- Header -->
<header id="wn__header" class="header__area header__absolute sticky__header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="{{route('homepage')}}">
                        <img src="images/logo/logo.png" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="{{route('homepage')}}">Trang chủ</a></li>
                        <li class="drop"><a href="index.html#">Cửa hàng</a>
                            <div class="megamenu mega03">
                                <ul class="item item03">
                                    <li class="title">Shop Layout</li>
                                    <li><a href="shop-grid.html">Shop Grid</a></li>
                                    <li><a href="shop-list.html">Shop List</a></li>
                                    <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                    <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                    <li><a href="shop-no-sidebar.html">Shop No sidebar</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Shop Page</li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                    <li><a href="error404.html">404 Page</a></li>
                                    <li><a href="faq.html">Faq Page</a></li>
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Bargain Books</li>
                                    <li><a href="shop-grid.html">Bargain Bestsellers</a></li>
                                    <li><a href="shop-grid.html">Activity Kits</a></li>
                                    <li><a href="shop-grid.html">B&N Classics</a></li>
                                    <li><a href="shop-grid.html">Books Under $5</a></li>
                                    <li><a href="shop-grid.html">Bargain Books</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="drop"><a href="shop-grid.html">Sách</a>
                            <div class="megamenu mega03">
                                <ul class="item item03">
                                    <li class="title">Categories</li>
                                    <li><a href="shop-grid.html">Biography </a></li>
                                    <li><a href="shop-grid.html">Business </a></li>
                                    <li><a href="shop-grid.html">Cookbooks </a></li>
                                    <li><a href="shop-grid.html">Health & Fitness </a></li>
                                    <li><a href="shop-grid.html">History </a></li>
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Customer Favourite</li>
                                    <li><a href="shop-grid.html">Mystery</a></li>
                                    <li><a href="shop-grid.html">Religion & Inspiration</a></li>
                                    <li><a href="shop-grid.html">Romance</a></li>
                                    <li><a href="shop-grid.html">Fiction/Fantasy</a></li>
                                    <li><a href="shop-grid.html">Sleeveless</a></li>
                                </ul>
                                <ul class="item item03">
                                    <li class="title">Collections</li>
                                    <li><a href="shop-grid.html">Science </a></li>
                                    <li><a href="shop-grid.html">Fiction/Fantasy</a></li>
                                    <li><a href="shop-grid.html">Self-Improvemen</a></li>
                                    <li><a href="shop-grid.html">Home & Garden</a></li>
                                    <li><a href="shop-grid.html">Humor Books</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="drop"><a href="blog.html">Tin tức</a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    <li><a href="blog.html">Blog Page</a></li>
                                    <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="about.html">Về chúng tôi</a></li>
                        <li><a href="contact.html">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li class="shop_search"><a class="search__active" href="index.html#"></a></li>
                    <li class="wishlist"><a href="index.html#"></a></li>
                    <li class="shopcart"><a class="cartbox_active" href="index.html#"><span class="product_qun">3</span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <?php $total = 0 ?>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $key => $carts)
                                            <?php $total += $carts['final_price'] * $carts['quantity'] ?>
                                            <div class="micart__close">
                                                <span>close</span>
                                            </div>
                                            <div class="single__items">
                                                <div class="miniproduct">
                                                    <div class="item01 d-flex mt--20">
                                                        <div class="thumb">
                                                            <a href="#"><img src="{{@$carts['image']}}" alt="product images"></a>
                                                        </div>
                                                        <div class="content">
                                                            <h6><a href="#">{{@$carts['title']}}</a></h6>
                                                            <span class="prize">{{@$carts['final_price']}}</span>
                                                            <div class="product_prize d-flex justify-content-between">
                                                                <span class="qun">Số lượng : {{@$carts['quantity']}}</span>
                                                                <ul class="d-flex justify-content-end">
                                                                    <li><a href="index.html#"><i class="zmdi zmdi-settings"></i></a></li>
                                                                    <li><button class="btn btn-sm remove-from-cart" data-id="{{ @$id }}"><i class="fa fa-trash-o"></i></button></li>
                                                                    {{--<li><a data-id="{{ @$id }}"><i class="zmdi zmdi-delete"></i></a></li>--}}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mini_action cart">
                                                <a class="cart__btn" href="cart.html">View and edit cart</a>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="items-total d-flex justify-content-between">
                                        <span>3 items</span>
                                        <span>Cart Subtotal</span>
                                    </div>
                                    <div class="total_amount text-right">
                                        <span>{{ @$total }}.000đ</span>
                                    </div>
                                    <div class="mini_action checkout">
                                        <a class="checkout__btn" href="#">Go to Checkout</a>
                                    </div>
                            </div>
                        </div>
                        <!-- End Shopping Cart -->
                    </li>
                    <li class="setting__bar__icon"><a class="setting__active" href="index.html#"></a>
                        <div class="searchbar__content setting__block">
                            <div class="content-inner">
                                <div class="switcher-currency">
                                    <strong class="label switcher-label">
                                        <span>My Account</span>
                                    </strong>
                                    <div class="switcher-options">
                                        <div class="switcher-currency-trigger">
                                            <div class="setting__menu">
                                                @if(Session::has('token') && Session::get('login') == true)
                                                    <span><a href="#">{{Session::get('name')}}</a></span>
                                                    <span><a href="{{route('logout')}}">Đăng xuất</a></span>
                                                @else
                                                    <span><a href="{{route('login')}}">Đăng nhập</a></span>
                                                    <span><a href="{{route('register')}}">Đăng ký</a></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start Mobile Menu -->
        <div class="row d-none">
            <div class="col-lg-12 d-none">
                <nav class="mobilemenu__nav">
                    <ul class="meninmenu">
                        <li><a href="index.html">Home</a>
                            <ul>
                                <li><a href="index.html">Home Style Default</a></li>
                                <li><a href="index-2.html">Home Style Two</a></li>
                                <li><a href="index-box.html">Home Box Style</a></li>
                            </ul>
                        </li>
                        <li><a href="index.html#">Pages</a>
                            <ul>
                                <li><a href="about.html">About Page</a></li>
                                <li><a href="portfolio.html">Portfolio</a>
                                    <ul>
                                        <li><a href="portfolio.html">Portfolio</a></li>
                                        <li><a href="portfolio-three-column.html">Portfolio 3 Column</a></li>
                                        <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                                <li><a href="wishlist.html">Wishlist Page</a></li>
                                <li><a href="error404.html">404 Page</a></li>
                                <li><a href="faq.html">Faq Page</a></li>
                                <li><a href="team.html">Team Page</a></li>
                            </ul>
                        </li>
                        <li><a href="shop-grid.html">Shop</a>
                            <ul>
                                <li><a href="shop-grid.html">Shop Grid</a></li>
                                <li><a href="shop-list.html">Shop List</a></li>
                                <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                <li><a href="shop-no-sidebar.html">Shop No sidebar</a></li>
                                <li><a href="single-product.html">Single Product</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a>
                            <ul>
                                <li><a href="blog.html">Blog Page</a></li>
                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Mobile Menu -->
        <div class="mobile-menu d-block d-lg-none">
        </div>
        <!-- Mobile Menu -->
    </div>
</header>
<!-- //Header -->
<!-- Start Search Popup -->
<div class="brown--color box-search-content search_active block-bg close__top">
    <form id="search_mini_form" class="minisearch" action="index.html#">
        <div class="field__search">
            <input type="text" placeholder="Search entire store here...">
            <div class="action">
                <a href="index.html#"><i class="zmdi zmdi-search"></i></a>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->