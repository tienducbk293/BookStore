@extends('admin.layouts.master')
@section('content')
<ul class="breadcrumb">
  <li>
      <i class="icon-home"></i>
      <a href="{{ route('admin.dashboard') }}">Trang chủ</a>
      <i class="icon-angle-right"></i> 
  </li>
  <li>
      <i class="fa fa-th" aria-hidden="true"></i>
      <a href="{{ route('user.list')}}">Danh sách tài khoản </a>
  </li>
</ul>
<div class="row-fluid sortable">
<div class="box span12">
    @include('admin.layouts.errors')
    <div class="box-header" data-original-title>
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Thêm mới thành viên</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form class="form-horizontal" action="{{ route('user.postAdd')}}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <fieldset>
          <legend style="font-size: 18px;">Thông tin tài khoản</legend>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên đăng nhập </label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="name" value="" placeholder="Nhập tên...">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Email</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="email" value="" placeholder="Nhập Email...">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Mật khẩu</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="password" name="password" value="" placeholder="Nhập mật khẩu">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Xác nhận mật khẩu</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="password" name="password_confirmation" value="" placeholder="Xác nhận mật khẩu">
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Level</label>
                <div class="controls">
                    <label class="radio" style="float: left;">
                        <input type="radio" name="level" id="optionsRadios2" value="2" checked="">
                        Nhân viên
                    </label>
                </div>
                <div class="controls">
                  <label class="radio" style="float: left;">
                    <input type="radio" name="level" id="optionsRadios2" value="3" checked="">
                      Khách hàng
                  </label>
                </div>
            </div>
          </fieldset>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Thêm thành viên</button>
            <button type="reset" class="btn">Hủy</button>
          </div>
        </form>  
    </div>
</div><!--/span-->
</div><!--/row-->
@endsection