@extends('admin.master')
@section('content')
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="{{ url ('/')}}">Trang chủ</a> 
	<i class="icon-angle-right"></i>
</li>
<li>
  <i class="fa fa-th" aria-hidden="true"></i>
  <a href="{{ route('admin.book.getList')}}">Danh sách sản phẩm </a>
  <i class="icon-angle-right"></i>
</li>
<li>
	<i class="icon-plus-sign"></i>
	<a href="{{URL::route('admin.book.getAdd')}}">Thêm mới sản phẩm </a>
</li>
</ul>
<div class="row-fluid sortable">	
<div class="box span12">
	<div class="box-header">
		<h2 id="txtName"><i class="fa fa-info-circle" aria-hidden="true"></i><span class="break"></span>Thông tin chi tiết sản phẩm : {{ old('txtName',isset($data) ? $data['name'] : null)}}</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<fieldset>
			<table class="table table-bordered table-striped table-condensed">
				  <thead>
					  <tr>
						  <th>Tên sản phẩm</th>
						  <th>Giá nhập</th>
						  <th>Giá bán</th>
						  <th>Giá khuyến mãi</th>  
						  <th>Số lượt xem</th>    
						  <th style="text-align: center;">User_Id</th>                                            
					  </tr>
				  </thead>   
				  <tbody>
					<tr>
						<td id="txtName">{{ old('txtName',isset($data) ? $data['name'] : nul)}}</td>
						<td class="center" id="txtCost">{{ number_format(old('txtCost',isset($data) ? $data['cost'] : nul),0,',','.')}}</td>
						<td class="center" id="txtUnit_price">{{ number_format(old('txtUnit_price',isset($detail) ? $detail['unit_price'] : nul),0,',','.')}}</td>
						<td class="center" id="txtPromotion_price">{{ number_format(old('txtPromotion_price',isset($detail) ? $detail['promotion_price'] : nul),0,',','.')}}</td>
						<td class="center" id="txtView">{{ old('txtView',isset($detail) ? $detail['view'] : nul)}}</td>
						<td class="center" style="text-align: center;">{{ old('',isset($data) ? $data['user_id'] : nul)}}</td>                            
				  </tbody>
			 </table>  
		 	<form action="" class="form-group" >
            <fieldset>
	            <legend style="font-size: 18px;"></legend>
	            <legend  style="width: 25%;font-size: 14px;text-align: center;">Hình ảnh sản phẩm</legend>
	            <div class="controls" style="width: 26%;margin-top: 5px;">
	                <img src="{{ asset('resources/upload/'.$data['image'])}}">
	            </div>
	              @if($product_count == 0)
	                <legend  style="width: 25%;font-size: 14px;text-align: center;">Sản phẩm chưa có hình ảnh chi tiết</legend>
	              @else
	              <legend style="width: 20%;font-size: 14px;text-align: center;">Hình ảnh chi tiết sản phẩm</legend>
	                <div class="control-group" >
	                @foreach($product_image as  $item)
	                  <div class="controls"  style="width: 20%;float: left;" >
	                     <img src="{{ asset('resources/upload/detail/'.$item['image'])}}" style="width: 215px;height: 143px;margin:  0 auto;">
	                  </div>
	               	 @endforeach
	              </div>
	              @endif
            </fieldset>
          </form>
		</fieldset>

	</div>
</div><!--/span-->
</div><!--/row-->
@endsection