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
	 <a href="{{ route('user.add') }}">Thêm mới thành viên </a>
  </li>
</ul>
<div class="row-fluid sortable">		
<div class="box span12">
	@include('admin.layouts.alerts')
	<div class="box-header" data-original-title>
		<h2><i class="halflings-icon white user"></i><span class="break"></span>Danh sách tài khoản</h2>
		<div class="box-icon">
			<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
			<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
			<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
		</div>
	</div>
	<div class="box-content">
		<form method="get">
			<input type="hidden" name="_token" value="{{ csrf_token()}}">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
				  	  <th style="text-align: center;">STT</th>
					  <th>Tên thành viên</th>
					  <th>Email</th>
					  <th>Password</th>
                      <th>Level</th>
					  <th>Sửa / Xóa</th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php $stt=0;?>
			  	@foreach($list_users as $key => $user)
			  	<?php 
			  		$stt++;
			  	?>
				<tr>
					<td style="text-align: center;">{{ $stt}}</td>
					<td>{{ @$user['name']}}</td>
					<td class="center">{{ @$user['email'] }}</td>
                    <td class="center">{{ @$user['password'] }}</td>
					<td class="center">
						@if($user['level'] == 1)
                            <span class="label label-warning">Quản lý</span>
						@elseif($user['level'] == 2)
                            <span class="label label-success">Nhân viên</span>
						@else
							<span class="label label-default">Khách hàng</span>
						@endif
					</td>
					<td class="center">
						<a class="btn btn-info" href="{{ route('user.edit', $key) }}">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a onclick="return xacnhanxoa('Bạn có muốn xóa không ?')"  class="btn btn-danger" href="{{ route('user.delete', $key) }}">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
				@endforeach
			  </tbody>
		  </table>    
		</form>        
	</div>
</div><!--/span-->

</div><!--/row-->
@endsection