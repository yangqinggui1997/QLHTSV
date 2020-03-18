@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ THÔNG BÁO NGƯỜI DÙNG | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
@endsection
@section('css')
<!-- Datatables -->
<link href="resources/bootstraps/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/bootstraps/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" media="all">
<!-- bootstrap-daterangepicker -->
<link href="resources/bootstraps/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" media="all">
<!-- bootstrap-datetimepicker -->
<link href="resources/bootstraps/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet" media="all">
@endsection
@section('content')
<div class="">
	<div class="row">
		<!-- chèn nội dung trang -->
		<!-- Biểu mẫu dạng xml nếu có -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__bieuMauDangXML" style="display: none">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2 id="h2__id__bieuMauDangXML">BIỂU MẪU ĐĂNG KÝ ... </h2>
			        <ul class="nav navbar-right panel_toolbox">
			        	<li><a class="close-link"><i class="fa fa-close"></i></a>
			        	</li>
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left" novalidate id="form__id__noiDungBieuMauXML"></form>
		      	</div>
		    </div>
		</div>
		<!-- Danh sách thông báo -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__danhSachTB" style="display: none">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2 id="h2__id__tieuDeDSTB"></h2>
			    	<ul class="nav navbar-right panel_toolbox">
			    		<li><a class="close-link"><i class="fa fa-close"></i></a>
			    		</li>
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__thongBao" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
					      		<thead>
					        		<tr>
							          	<th data-th-td><input type="checkbox" data-checkbox-tb="p"></th>
							          	<td>#</td>
							          	<th>TIÊU ĐỀ</th>
							          	<th>NỘI DUNG</th>
							          	<th>NỘI DUNG ĐÍNH KÈM</th>
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__thongBao"></tbody>
					    	</table>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
		<!-- Danh sách người dùng -->
	  	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2>DANH SÁCH NGƯỜI DÙNG</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__nguoiDung" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
							          	<th>#</th>
							          	<th>NGƯỜI DÙNG</th>
							          	<th>EMAIL</th>
							          	<th>QUYỀN HẠN</th>
							          	<th>NGÀY TẠO TÀI KHOẢN</th>
							          	<th width="5%">SỐ LẦN ĐĂNG NHẬP</th>
							          	<th>ĐĂNG NHẬP LẦN CUỐI</th>
							          	<th>TRẠNG THÁI</th>
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__nguoiDung">
							    	@foreach($danhSachND as $i => $nguoiDung)
								    <tr>
										<td>{{($i+1)}}</td>
								        <td class="text-center">
								        	<a href="javascript:void(0)" data-a-nd-userId="{{$nguoiDung->maND}}">
								        		<label>
								        			<div class="avatar-wrap{{$nguoiDung->classTT}}">
		                                                <div class="avatarTiny avatar-tiny">
		                                                    <img src="{{$nguoiDung->anh}}" alt="Ảnh người dùng">
		                                                </div>
		                                            </div>
								        		</label>
								        		<br>
								        		<span style="line-height: unset;margin-top:2px">{{$nguoiDung->tenND}}</span>
								        	</a>
								        </td>
								        <td>{{$nguoiDung->email}}</td>
								        <td>{{$nguoiDung->quyen}}</td>
								        <td class="text-center">{!!$nguoiDung->ngayTTK!!}</td>
								        <td>{{$nguoiDung->soLanDN}}</td>
								        <td class="text-center">{!!$nguoiDung->dangNhapLC!!}</td>
								        <td>{{$nguoiDung->trangThai}}</td>
								        <td>
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách thông báo của người dùng" data-button-id="xemDSTB" data-button-maND="{{$nguoiDung->maND}}" data-button-tenND="{{$nguoiDung->tenND}}"><i class="fa fa-fax"></i></button>
				                          	</div>
					                    </td>
								    </tr>
								    @endforeach
							    </tbody>
					    	</table>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<!-- validator -->
<script src="resources/bootstraps/validator/validator.js"></script>
<!-- Datatables -->
<script src="resources/js/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="resources/bootstraps/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="resources/js/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="resources/bootstraps/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="resources/js/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="resources/js/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="resources/js/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="resources/js/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="resources/js/pdfmake/build/pdfmake.min.js"></script>
<script src="resources/js/pdfmake/build/vfs_fonts.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="resources/js/moment/min/moment.min.js"></script>
<script src="resources/bootstraps/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="resources/bootstraps/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
@endsection
@section('specifiedScript')
<!-- Các hàm dùng chung trong project -->
@include('js.common')
<!-- Khởi tạo side bar -->
@include('js.khoi_tao_side_bar')
<!-- Khởi tạo các chức năng thanh công cụ menu -->
@include('js.thanh_cong_cu_menu')
<!-- Khởi tạo data table -->
@include('admin.js.ql_thong_bao.0_khoi_tao_dataTable_ql_tb')
<!-- Khởi tạo sự kiện check record table -->
@include('admin.js.ql_thong_bao.1_checkbox_table_thong_bao')
<!-- Khởi tạo sự kiện clcik nút xem danh sách thông báo -->
@include('admin.js.ql_thong_bao.2_nut_xem_ds_thong_bao')
<!-- Khởi tạo sự kiện click nút xoá thông báo trên table -->
@include('admin.js.ql_thong_bao.3_nut_xoa_tb_tren_table')
<!-- Khởi tạo sự kiện click nút xoá thông báo trên danh sách -->
@include('admin.js.ql_thong_bao.4_nut_xoa_tb_tren_ds')
<!-- Khởi tạo sự kiện click nút xem nội dung biểu mẫu dạng xml -->
@include('admin.js.ql_thong_bao.5_xem_noi_dung_bmXML')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection