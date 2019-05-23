@extends('layout.master')
@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Shopping Cart</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="{{route('homepage')}}">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Shopping Cart</span>
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
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $totals = 0 ?>

                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)

                                    <?php
                                    $total = $details['price'] * $details['quantity'];
                                    $totals += $total;
                                    ?>

                                    <tr>
                                        <td class="product-thumbnail"><a href="{{route('detail', $id)}}"><img src="{{ $details['image'] }}" alt="product img"></a></td>
                                        <td class="product-name"><a href="{{route('detail', $id)}}">{{ $details['title'] }}</a></td>
                                        <td class="product-price"><span class="amount">{{ $details['price'] }}</span></td>
                                        <td class="product-quantity"><input type="number" value="{{ $details['quantity'] }}" class="form-control quantity"></td>
                                        <td class="product-subtotal">
                                            <span>{{ @$total }} đ</span>
                                        </td>
                                        <td class="actions" data-th="" id="update-cart">
                                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}" id="update-cart"><i class="fa fa-refresh"></i></button>
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="cartbox__btn">
                        <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                            <li><a href="{{ url('/') }}" class="btn"><i class="fa fa-angle-left"></i>Tiếp tục mua hàng</a></li>
                            <li><a href="@if(Session::has('token') && Session::get('login') == true) {{ route('order') }} @else {{ route('login') }} @endif">Thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="cartbox__total__area">
                        <div class="cart__total__amount">
                            <span>Tổng cộng</span>
                            <span>
                                <span>{{ @$totals }} đ</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
@endsection