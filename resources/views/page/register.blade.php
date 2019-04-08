@extends('layout.master')
@section('content')
    <div class="login bg-image--login">
        <div class="container">
            <div class="row">
                <div class="Absolute-Center is-Responsive">
                    <div class="col-md-12">
                        <div class="box sign-box">
                            <div class="header">
                                <h4>Cửa hàng mua bán sách trực tuyến</h4>
                            </div>
                            <br>
                            <p>Vui lòng điền thông tin đăng ký của bạn bên dưới</p>

                            <form class="m-t" action="{{route('register')}}" accept-charset="UTF-8" method="post">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $err)
                                            {{$err}}
                                        @endforeach
                                    </div>
                                @endif
                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autofocus="autofocus" autocomplete="email" class="form-control" placeholder="Email của bạn" type="email" value="" name="email" id="email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">Họ tên</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autofocus="autofocus" autocomplete="name" class="form-control" placeholder="Họ tên của bạn" type="name" value="" name="name" id="name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Mật khẩu</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autocomplete="off" class="form-control" placeholder="Nhập mật khẩu" type="password" name="password" id="password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Mật khẩu nhập lại</label>
                                    <div class="input-wrap has-feedback has-error">
                                        <input autocomplete="off" class="form-control" placeholder="Nhập lại mật khẩu" type="password" name="re_password" id="re_password" />
                                    </div>
                                </div>
                                <div class="actions">
                                    <input type="submit" name="register" value="Đăng ký" class="btn btn-primary block full-width m-b" data-disable-with="Loading..." />
                                    <a class="btn btn-link" href="{{route('login')}}"><i>Bạn đã có tài khoản?</i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection