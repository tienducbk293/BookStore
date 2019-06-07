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
        <aside class="wedget__categories poroduct--tag">
            <h3 class="wedget__title">Thẻ sản phẩm</h3>
            <ul>
                @foreach($categories as $key => $category)
                    <li><a href="{{ route('category', $category['slug']) }}">{{ $category['category_name'] }}</a></li>
                @endforeach
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