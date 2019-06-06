<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
	<div class="nav-collapse sidebar-nav">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li><a href="{{ route('admin.dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
			<li><a href="{{ route('user.list') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span class="hidden-tablet"> Quản lý thành viên</span></a></li>
			<li><a href="{{ route('book.list') }}"><i class="fa fa-book" aria-hidden="true"></i><span class="hidden-tablet"> Quản lý sản phẩm</span></a></li>
			<li><a href="{{ route('order.list') }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="hidden-tablet"> Quản lý đơn hàng</span></a></li>
		</ul>
	</div>

</div>
<!-- end: Main Menu -->