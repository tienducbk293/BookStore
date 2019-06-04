<!-- Header -->
@if(Request::is('/'))
    <header id="wn__header" class="header__area header__absolute sticky__header">
@else
    <header id="wn__header" class="oth-page header__area header__absolute sticky__header">
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="{{route('homepage')}}">
                        <img src="images/logo/basa.png" alt="logo images">
                    </a>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex justify-content-start" >
                        <li class="drop with--one--item" style="position: relative;"><a href="{{route('homepage')}}">Trang chủ</a></li>
                        <li class="drop"><a href="index.html#">Cửa hàng</a>
                            <div class="megamenu dropdown">
                                <ul class="item item01">
                                    @foreach($categories as $key => $category)
                                        <li class="label2"><a href="{{ route('category', $category['slug']) }}">{{ $category['category_name'] }}</a>
                                            @if(isset($category['children']))
                                                <ul>
                                                    @foreach($category['children'] as $key => $children)
                                                        <li><a href="{{ route('category', $children['slug']) }}">{{ $children['category_name'] }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
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
                    <li class="shop_search"><a class="search__active" href="#"></a></li>
                    <?php
                    $user_key = session()->get('user_key');
                    ?>
                    <li class="wishlist"><a href="{{ route('listlike', $user_key[0]) }}"></a></li>
                    <li class="shopcart">
                        <a class="cartbox_active" id="cartinfo_active" href="{{ route('cart') }}">
                            <span class="product_qun">
                                @if(session('cart'))
                                    <?php echo count(session('cart')); ?>
                                @else
                                    <?php echo 0; ?>
                                @endif
                            </span></a>
                        <!-- Start Shopping Cart -->
                        <div class="block-minicart minicart__active">
                            <div class="minicart-content-wrapper">
                                <?php $total = 0; ?>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $carts)
                                        <?php
                                        $total += $carts['price'] * $carts['quantity'];
                                        ?>
                                        <div class="single__items">
                                            <div class="miniproduct">
                                                <div class="item01 d-flex mt--20">
                                                    <div class="thumb">
                                                        <a href="#"><img src="{{@$carts['image']}}" alt="product images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <p><a href="#">{{@$carts['title']}}</a></p>
                                                        <span class="prize">{{@$carts['price']}}</span>
                                                        <div class="product_prize d-flex justify-content-between">
                                                            <span class="qun">Số lượng : {{@$carts['quantity']}}</span>
                                                            <ul class="d-flex justify-content-end">
                                                                <li><a class="remove-from-cart" data-id="{{ @$id }}"><i class="zmdi zmdi-delete"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                    <div class="mini_action cart">
                                        <a class="cart__btn" href="{{ route('cart') }}">Chi tiết đơn hàng</a>
                                    </div>
                                    <div class="items-total d-flex justify-content-between">
                                        <span>
                                            @if(session('cart'))
                                                <?php echo count(session('cart')); ?>
                                            @else
                                                <?php echo 0; ?>
                                            @endif
                                             items
                                        </span>
                                        <span>Tổng đơn hàng</span>
                                    </div>
                                    <div class="total_amount text-right">
                                        <span>{{ @$total }} đ</span>
                                    </div>
                                    <div class="mini_action checkout">
                                        <a class="checkout__btn" href="@if(Session::has('token') && Session::get('login') == true) {{ route('order') }} @else {{ route('login') }} @endif">Thanh toán</a>
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
                                                    <span><a href="{{ route('dashboard') }}">{{Session::get('user_name')}}</a></span>
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
                    <ul class="meninmenu d-flex justify-content-start">
                        <li class="drop with--one--item"><a href="index.html">Home</a>
                            <div class="megamenu dropdown">
                                <ul>
                                    <li><a href="index.html">Home Style Default</a></li>
                                    <li><a href="index-2.html">Home Style Two</a></li>
                                    <li><a href="index-box.html">Home Box Style</a></li>
                                </ul>
                            </div>
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
    <form id="search_mini_form" class="minisearch" accept-charset="UTF-8" action="{{ route('search') }}" method="get">

        <div class="form-group field__search">
            <input type="text" name="search" placeholder="Tìm kiếm ở đây...">
            <div class="action">
                <button type="submit"><i class="zmdi zmdi-search"></i></button>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>
<!-- End Search Popup -->