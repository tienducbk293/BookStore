@extends('admin.layouts.master')
@section('content')
<ul class="breadcrumb">
<li>
	<i class="icon-home"></i>
	<a href="{{ route('admin.dashboard') }}">Trang chủ</a>
	<i class="icon-angle-right"></i>
</li>
</ul>
@include('admin.layouts.alerts')
<div class="row-fluid sortable">		
<div class="box span12">
	<div class="box-header" data-original-title>
		<h2><i class="icon-th-list"></i><span class="break"></span>Danh sách hóa đơn</h2>
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
				  <th>Tên người nhận</th>
				  <th>Địa chỉ nhận</th>
				  <th>Số điện thoại</th>
				  <th>Tổng tiền</th>
				  <th>Số mặt hàng</th>
				  <th style="text-align: center;"> Xóa</th>
			  </tr>
		  </thead>   
		  <tbody>
		  	<?php $stt = 0;?>
		  	@foreach($orders as $key => $order)
		  	<?php $stt++;?>
			<tr>
				<td class="center" style="text-align: center;">{{ $stt }}</td>
				<td >{{ @$order['name'] }}</td>
				<td >{{ @$order['address'] }}</td>
				<td>{{ @$order['phone'] }}</td>
				<td>{{ @$order['total_amount'] }}</td>
				<td>{{ count($order['detail']) }}</td>
				<td class="center" style="text-align: center;">
					<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')" class="btn btn-danger" href="{{route('order.delete',$key)}}">
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