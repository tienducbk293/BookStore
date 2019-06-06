@extends('admin.layouts.master')
@section('content')
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="{{ route('admin.dashboard') }}">Trang chủ</a>
	<i class="icon-angle-right"></i>
</li>
<li>
	<i class="icon-plus-sign"></i>
	<a href="{{ route('book.add') }}">Thêm mới sản phẩm </a>
</li>
</ul>
@include('admin.layouts.alerts')
<div class="row-fluid sortable">		
<div class="box span12">
	<div class="box-header" data-original-title>
		<h2><i class="icon-th-list"></i><span class="break"></span>Danh sách sản phẩm</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<table class="table table-striped table-bordered bootstrap-datatable datatable">
		  <thead>
			  <tr>
				  <th style="text-align: center;">STT</th>
				  <th>Mã sách</th>
				  <th>Tên sách</th>
				  <th>Danh mục sản phẩm</th>
				  <th>Tên tác giả</th>
				  <th>Đơn giá</th>
				  <th>Khuyến mại</th>
				  <th>Số lượng</th>
				  <th style="text-align: center;"> Sửa / Xóa</th>
			  </tr>
		  </thead>   
		  <tbody>
		  	<?php $stt = 0;?>
		  	@foreach($list_books as $key => $book)
		  	<?php $stt++;?>
			<tr>
				<td class="center" style="text-align: center;">{{ $stt }}</td>
				<td >{{@$book['book_id']}}</td>
				<td >{{@$book['title']}}</td>
				<td >{{ @$book['category'] }}</td>
				<td >{{ @$book['author'] }}</td>
				<td>{{ @$book['price_regular'] }}</td>
				<td>{{ @$book['final_price'] }}</td>
				<td>{{ @$book['quantity'] }}</td>
				<td class="center" style="text-align: center;">
					<a class="btn btn-info" href="{{ route('book.edit', $book['book_id']) }}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')" class="btn btn-danger" href="{{ route('book.delete', $key) }}">
						<i class="halflings-icon white trash"></i> 
					</a>
				</td>
			</tr>	
			@endforeach
		  </tbody>
	  </table>            
	</div>
</div><!--/span-->

</div><!--/row-->
@endsection