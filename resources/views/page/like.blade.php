@extends('layouts.master')
@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Like List</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="{{route('homepage')}}">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Like List</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <div class="table-content wnro__table table-responsive">
                        <table>
                            <thead>
                            <tr class="title-top">
                                <th class="product-thumbnail">Ảnh</th>
                                <th class="product-name">Sách</th>
                                <th class="product-name">Tác giả</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-price">Giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $key => $book)
                                <tr>
                                    <td class="product-thumbnail"><a href="{{route('detail', $book['book_id'])}}"><img src="{{ $book['image'] }}" alt="product img"></a></td>
                                    <td class="product-name"><a href="{{route('detail', $book['book_id'])}}">{{ $book['title'] }}</a></td>
                                    <td class="product-name"><a href="#">{{ $book['author'] }}</a></td>
                                    <td class="product-quantity"><span class="amount">{{ $book['quantity'] }}</span></td>
                                    <td class="product-price"><span class="amount">{{ $book['final_price'] }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
@endsection