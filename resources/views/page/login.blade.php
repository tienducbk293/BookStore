@extends('layout.master')
@section('content')
    <div class="login bg-image--login">
        <div class="container">
            <div class="row">
                <div class="Absolute-Center is-Responsive">
                    <div class="col-md-12">
                        <div class="box sign-box" id="login_div">
                            <div class="header">
                                <h4>Cửa hàng mua bán sách trực tuyến</h4>
                            </div>
                            <br>
                            <p>Vui lòng điền thông tin đăng nhập của bạn bên dưới</p>

                            <form class="m-t" action="{{route('login')}}" accept-charset="UTF-8" method="post" >
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                @if(Session::has('flag'))
                                    <div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>

                                @endif
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autofocus="autofocus" autocomplete="email" class="form-control" placeholder="Email của bạn" type="email" value="" name="email" id="email_field" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Mật khẩu</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autocomplete="off" class="form-control" placeholder="Nhập mật khẩu" type="password" name="password" id="password_field" required>
                                    </div>
                                </div>

                                <div class="actions">
                                    <input type="submit" name="login" value="Đăng nhập" class="btn btn-primary block full-width m-b" data-disable-with="Loading...">
                                    <a class="btn btn-link" href="#">Quên mật khẩu?</a>
                                    <a class="btn btn-link" href="{{route('register')}}"><i>Tạo tài khoản mới</i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection