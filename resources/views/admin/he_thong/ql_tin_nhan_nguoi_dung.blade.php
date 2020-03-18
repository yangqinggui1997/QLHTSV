@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ TIN NHẮN NGƯỜI DÙNG | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
@endsection
@section('css')
<!-- Datatables -->
<link href="resources/bootstraps/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/bootstraps/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" media="all">
@endsection
@section('content')
<div class="">
	<div class="row">
		<!-- chèn nội dung trang -->
		<!-- Form xem cuộc trò chuyện của người dùng -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formTinNhan" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2 id="h2__id__tieuDeFormTN"></h2>
			        <ul class="nav navbar-right panel_toolbox">
			        	<li><a class="close-link"><i class="fa fa-close"></i></a>
			    		</li>
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left" novalidate>
		        		<div class="item form-group">
		        			<div class="col-md-1 col-sm-1 col-xs-1"></div>
		        			<div class="col-md-10 col-sm-10 col-xs-10 frameChat">
		        				<!-- Avatar title -->
		        				<div class="row avatarTitle">
		        					<div class="col-md-12 col-sm-12 col-xs-12">
		        						<div class="row">
				        					<div class="col-md-12 col-sm-12 col-xs-12 avatarImg">
				        						<label>
				        							<div class="avatar-wrap">
	                                                    <div class="avatar avatar--small">
	                                                        <img src="" alt="" id="img__id__anhNN">
	                                                    </div>
	                                                </div>
				        						</label>
                                            </div>
				        				</div>
				        				<div class="row">
				        					<div class="col-md-12 col-sm-12 col-xs-12 avatarText">
				        						<label id="label__id__tdctt"></label>
				        					</div>
				        				</div>
		        					</div>
		        				</div>
		        				<div id="div__id__noiDungTT"></div>
		        			</div>
		        			<div class="col-md-1 col-sm-1 col-xs-1"></div>
		        		</div>
		        	</form>
		      	</div>
		    </div>
		</div>
		<!-- Danh sách người nhận -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__danhSachNguoiNhan" style="display: none;">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2 id="h2__id__danhSachNguoiNhan"></h2>
			    	<ul class="nav navbar-right panel_toolbox">
			    		<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__tinNhan" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
					      		<thead>
					        		<tr>
							          	<th data-th-td><input type="checkbox" data-checkbox-tn="p"></th>
							          	<th>#</th>
							          	<th>NGƯỜI NHẬN</th>
							          	<th>TG BẮT ĐẦU TRÒ CHUYỆN</th>
							          	<th>TG TRUYỆN GẦN NHẤT</th>
							          	<th>TỔNG TG TRÒ TRUYỆN</th>
							          	<th>TỔNG SỐ TN GỬI</th>
							          	<th>TỔNG SỐ TN NHẬN</th>
							          	<th>TRẠNG THÁI NGƯỜI NHẬN</th>
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__tinNhan"></tbody>
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
							<table id="table__id__nguoiDung" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
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
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách liên hệ" data-button-id="xemDSND" data-button-maND="{{$nguoiDung->maND}}" data-button-tenND="{{$nguoiDung->tenND}}"><i class="fa fa-fax"></i></button>
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
@endsection
@section('specifiedScript')
<!-- Các hàm dùng chung trong project -->
@include('js.common')
<!-- Khởi tạo side bar -->
@include('js.khoi_tao_side_bar')
<!-- Khởi tạo các chức năng thanh công cụ menu -->
@include('js.thanh_cong_cu_menu')
<!-- Khởi tạo data table -->
@include('admin.js.ql_tin_nhan.0_khoi_tao_dataTable_ql_tn')
<!-- Khởi tạo sự kiện check record table -->
@include('admin.js.ql_tin_nhan.1_checkbox_table_tin_nhan')
<!-- Khởi tạo sự kiện clcik nút xem danh sách liên hệ -->
@include('admin.js.ql_tin_nhan.2_nut_xem_ds_lien_he')
<!-- Khởi tạo sự kiện click nút xem nội dung trò chuyện -->
@include('admin.js.ql_tin_nhan.3_nut_xem_noi_dung_tt')
<!-- Khởi tạo sự kiện click nút xoá nội dung trò chuyện trên table-->
@include('admin.js.ql_tin_nhan.4_nut_xoa_noi_dung_tt_tren_table')
<!-- Khởi tạo sự kiện click nút xoá nội dung trò chuyện trên danh sách -->
@include('admin.js.ql_tin_nhan.5_nut_xoa_noi_dung_tt_tren_ds')
<!-- Khởi tạo sự kiện click nút xoá nội dung trò chuyện trên form-->
@include('admin.js.ql_tin_nhan.6_nut_xoa_noi_dung_tt_tren_form')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection