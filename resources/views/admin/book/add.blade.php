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
      <a href="{{ route('book.list')}}">Danh sách sản phẩm </a>
  </li>
</ul>
<div class="row-fluid sortable">
<div class="box span12">
    @include('admin.layouts.errors')
    <div class="box-header" data-original-title>
        <h2><i class="icon-plus-sign-alt"></i> <span class="break"></span>Thêm mới sản phẩm</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <form class="form-horizontal" action="{{ route('book.postAdd') }}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <fieldset>
          <legend style="font-size: 18px;">Thông tin sản phẩm</legend>
            <div class="control-group">
              <label class="control-label" for="typeahead">Danh mục sản phẩm</label> 
              <div class="controls">
                <select class="form-control" name="category">
                  @foreach($categories as $key => $category)
                        <option value="{{ $key }}">{{ $category['category_name'] }}</option>
                  @endforeach
                </select>
              </div>  
            </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Mã sản phẩm</label>
                  <div class="controls">
                      <input class="input-xlarge focused" id="book_id" type="text" name="title" value="">
                  </div>
              </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Tên sản phẩm</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="title" value="">
                </div>
            </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Tác giả</label>
                  <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="author" value="">
                  </div>
              </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Đơn giá</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="price_regular" value="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Giá khuyến mại</label>
                <div class="controls">
                  <input class="input-xlarge focused" id="focusedInput" type="text" name="final_price" value="">
                </div>
            </div>
              <div class="control-group">
                  <label class="control-label" for="focusedInput">Số lượng</label>
                  <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="quantity" value="">
                  </div>
              </div>
            <div class="control-group">
              <label class="control-label">Hình ảnh</label>
                <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="text" name="image" value="">
                </div>
            </div>
              <div class="control-group">
                  <label class="control-label">Hình ảnh chi tiết</label>
                  <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="detail_image" value="">
                  </div>
              </div>
            <div class="control-group">
                <label class="control-label" for="focusedInput">Nội dung</label>
                <div class="controls" style="width: 55%;">
                  <textarea class="form-control"  name="detail"></textarea>
                  <script type="text/javascript"> ckeditor("detail") </script>
                </div>
            </div>
          </fieldset>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <button type="reset" class="btn">Hủy</button>
          </div>
        </form>  
    </div>
</div><!--/span-->
</div><!--/row-->
@endsection