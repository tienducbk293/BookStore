@extends('layout.master')
@section('content')
    <div class="login bg-image--login">
        <?php //Hiển thị thông báo thành công?>
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
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