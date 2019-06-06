@extends('layouts.master')
@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Thanh toán</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index.html">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Thanh toán</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn_checkout_wrap">
                        <div class="checkout_info">
                            <span>Phản hồi khách hàng ?</span>
                            <a class="showlogin" href="checkout.html#">Nhấn vào đây để đăng nhập</a>
                        </div>
                        <div class="checkout_login">
                            <form class="wn__checkout__form" action="checkout.html#">
                                <p>Nếu bạn đã mua sắm với chúng tôi trước đây, vui lòng nhập thông tin của bạn vào các ô bên dưới. Nếu bạn là khách hàng mới, vui lòng tiếp tục với phần Thanh toán & Giao hàng.</p>

                                <div class="input__box">
                                    <label>Tên đăng nhập hoặc Email <span>*</span></label>
                                    <input type="text">
                                </div>

                                <div class="input__box">
                                    <label>Mật khẩu <span>*</span></label>
                                    <input type="password">
                                </div>
                                <div class="form__btn">
                                    <button>Đăng nhập</button>
                                    <label class="label-for-checkbox">
                                        <input id="rememberme" name="rememberme" value="forever" type="checkbox">
                                        <span>Nhớ mật khẩu</span>
                                    </label>
                                    <a href="checkout.html#">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>
                        <div class="checkout_info">
                            <span>Có phiếu giảm giá? </span>
                            <a class="showcoupon" href="checkout.html#">Nhấn vào đây để nhập mã của bạn</a>
                        </div>
                        <div class="checkout_coupon">
                            <form action="checkout.html#">
                                <div class="form__coupon">
                                    <input type="text" placeholder="Mã giảm giá">
                                    <button>Áp dụng giảm giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="{{ route('postOrder') }}" method="post">
                        <div class="customer_details">
                            <h3>Chi tiết thanh toán</h3>
                            <div class="customar__field">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="total_amount" value="{{ @$total_amount }}">
                                <div class="margin_between">
                                    <div class="input_box space_between">
                                        <label>Họ <span>*</span></label>
                                        <input type="text" name="firstname" placeholder="Nhập họ...">
                                    </div>
                                    <div class="input_box space_between">
                                        <label>Tên <span>*</span></label>
                                        <input type="text" name="lastname" placeholder="Nhập tên...">
                                    </div>
                                </div>
                                <div class="input_box">
                                    <label>Địa chỉ <span>*</span></label>
                                    <input type="text" name="address" placeholder="Địa chỉ...">
                                </div>
                                <div class="margin_between">
                                    <div class="input_box space_between">
                                        <label>Số điện thoại <span>*</span></label>
                                        <input type="text" name="phone" placeholder="Số điện thoại...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-checkout">
                            <button type="submit" name="checkout">Thanh toán</button>
                        </div>
                    </form>
                    <div class="customer_details mt--20">
                        <div class="differt__address">
                            <input name="ship_to_different_address" value="1" type="checkbox">
                            <span>Giao đến địa chỉ khác ?</span>
                        </div>
                        <div class="customar__field differt__form mt--40">
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Họ <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="input_box space_between">
                                    <label>Tên <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="input_box">
                                <label>Địa chỉ <span>*</span></label>
                                <input type="text" placeholder="Địa chỉ">
                            </div>
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Số điện thoại <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__order__box">
                        <h3 class="onder__title">Đơn hàng của bạn</h3>
                        <ul class="order__total">
                            <li>Sản phẩm</li>
                            <li>Tổng</li>
                        </ul>
                        <ul class="order_product">
                            <?php $totals = 0; ?>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $carts)
                                    <?php
                                    $total = $carts['price'] * $carts['quantity'];
                                    if (strpos($total, ".") !== false) {
                                        $explode = explode(".", $total);
                                        if (strlen($explode[1]) == 1) {
                                            $totals = $total."00 đ";
                                        } elseif(strlen($explode[1]) == 2) {
                                            $totals= $total."0 đ";
                                        } else {
                                            $totals = $total." đ";
                                        }
                                    } else {
                                        $totals = $total.".000 đ";
                                    }
                                    ?>
                                    <li>
                                        <img src="{{@$carts['image']}}" alt="product images">
                                        {{ @$carts['title'] }} × {{ @$carts['quantity'] }}
                                        <span>
                                            {{ @$totals }}
                                        </span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <ul class="shipping__method">
                            <li>Tổng đặt hàng <span>
                                    {{ @$total_amount }}
                                </span>
                            </li>
                        </ul>
                        <ul class="total__amount">
                            <li>Tổng đơn hàng <span>
                                    {{ @$total_amount }}
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-toggle="collapse" href="checkout.html#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Chuyển tiền trực tiếp tại ngân hàng</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="payment-body">Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán. Đơn hàng của bạn được vận chuyển cho đến khi tiền được xóa trong tài khoản của chúng tôi.</div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingTwo">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="checkout.html#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>Thanh toán bằng thẻ</span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="payment-body">Vui lòng gửi séc của bạn đến Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingThree">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="checkout.html#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span>Thanh toán khi giao hàng</span>
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="payment-body">Thanh toán bằng tiền mặt khi giao hàng.</div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingFour">
                                <a class="collapsed checkout__title" data-toggle="collapse" href="checkout.html#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span>PayPal <img src="images/icons/payment.png" alt="payment images"> </span>
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="payment-body">Thanh toán bằng tiền mặt khi giao hàng.</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout Area -->
@endsection