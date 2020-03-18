@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ KHOA / BỘ MÔN | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
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
		<!-- Danh sách cán bộ -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__danhSachCanBo" style="display: none;">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2 id="h2__id__danhSachCanBo">Danh sách cán bộ của bộ môn hoặc khoa [tênkhoaHoacbomon]</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			    		<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__canBo" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
							          	<th>#</th>
							          	<th>mã cán bộ</th>
							          	<th>CÁN BỘ</th><!-- ten + anh -->
							          	<th>GIỚI TÍNH</th>
							          	<th>SĐT</th>
							          	<th>EMAIL</th>
							          	<th>HỌC VỊ</th>
							          	<th>CHUYÊN MÔN</th>
							          	<th>NGHIỆP VỤ</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__canBo"></tbody>
					    	</table>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
		<!-- Form cập nhật bộ môn-->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formBoMon" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2 id="h2__id__formBoMon"></h2>
			        <ul class="nav navbar-right panel_toolbox">
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left" novalidate>
		        		<div class="item form-group">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Tên bộ môn</label>
		           			<div class="col-md-6 col-sm-6 col-xs-12">
		           				<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__tenBoMon" required placeholder="Công nghệ thông tin"> 
		            		</div>
		          		</div>
			          	<div class="ln_solid"></div>
			          	<div class="form-group text-center">
				            <div class="col-md-6 col-md-offset-3">
				            	<button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Cập nhật" id="button__id__capNhatBM">
				              		<i class="glyphicon glyphicon-ok"></i>
				              	</button>
				              	<button type="button" class="btn btn-danger" rel="tooltip" data-original-title="Huỷ" id="button__id__huyBM">
				              		<i class="glyphicon glyphicon-remove"></i>
				              	</button>
				            </div>
			          	</div>
		        	</form>
		      	</div>
		    </div>
		</div>
		<!-- Danh sách bộ môn -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__danhSachBoMon" style="display: none;">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2 id="h2__id__danhSachBoMon">DANH SÁCH BỘ MÔN KHOA [TENKHOA]</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="btn-group" id="div__id__button_group_boMon">
			  			<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Thêm bộ môn mới" id="button__id__themBM"><i class="glyphicon glyphicon-plus"></i></button>
			  			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Đóng danh sách" id="button__id__dongDanhSachBM"><i class="glyphicon glyphicon-remove"></i></button>
		  			</div>
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__boMon" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
					        			<th data-th-td-bm><input type="checkbox" data-checkbox-bm="p"></th>
							          	<th>#</th>
							          	<th>BỘ MÔN</th>
							          	<th>trưởng bộ môn</th>
							          	<th>SỐ LƯỢNG CÁN BỘ</th>
							          	<th>Chương trình đào tạo</th>
							          	<th>thao tác</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__boMon"></tbody>
					    	</table>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
		<!-- Form cập nhật khoa-->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formKhoa" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2>THÔNG TIN KHOA</h2>
			        <ul class="nav navbar-right panel_toolbox">
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left" novalidate>
		        		<div class="item form-group">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Tên khoa</label>
		           			<div class="col-md-6 col-sm-6 col-xs-12">
		           				<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__tenKhoa" required placeholder="Công nghệ thông tin"> 
		            		</div>
		          		</div>
			          	<div class="ln_solid"></div>
			          	<div class="form-group text-center">
				            <div class="col-md-6 col-md-offset-3">
				            	<button type="button" class="btn btn-success" data-toggle="tooltip" data-original-title="Cập nhật" id="button__id__capNhat">
				              		<i class="glyphicon glyphicon-ok"></i>
				              	</button>
				              	<button type="button" class="btn btn-danger" rel="tooltip" data-original-title="Huỷ" id="button__id__huy">
				              		<i class="glyphicon glyphicon-remove"></i>
				              	</button>
				            </div>
			          	</div>
		        	</form>
		      	</div>
		    </div>
		</div>
		<!-- Danh sách khoa -->
	  	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2>DANH SÁCH KHOA</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="btn-group" id="div__id__button_group_khoa">
		  				<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Thêm khoa mới" id="button__id__them"><i class="glyphicon glyphicon-plus"></i></button>
		  			</div>
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__khoa" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
							          	<th data-th-td-k><input type="checkbox" data-checkbox-k="p"></th>
							          	<th>#</th>
							          	<th>Khoa</th>
							          	<th>trưởng khoa</th>
							          	<th>số lượng cán bộ</th>
							          	<th>Chương trình đào tạo</th>
							          	<!-- ô trưởng khoa ở phía trên là hình đại diện, phía dưới ghi học hàm-học vị, tên-->
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__khoa">
							    	@foreach($dsKhoa as $i => $khoa)
								    <tr>
								        <td data-th-td-k>
											<input type="checkbox" data-checkbox-maKhoa="{{$khoa->idKhoa}}" data-checkbox-tenKhoa="{{$khoa->tenKhoa}}" data-checkbox-k="c">
										</td>
								        <td>{{($i+1)}}</td>
										<td>{{$khoa->tenKhoa}}</td>
								        <td class="text-center">
								        	@if($khoa->truongKhoa)
									        	<a href="javascript:void(0)">
									        		<label>
									        			<div class="avatar-wrap{{$khoa->truongKhoa->classTT}}">
			                                                <div class="avatarTiny avatar-tiny">
			                                                    <img src="{{$khoa->truongKhoa->anh}}" alt="Ảnh trưởng khoa">
			                                                </div>
			                                            </div>
									        		</label>
									        		<br>
									        		<span style="line-height: unset;margin-top:2px">{{$khoa->truongKhoa->ten}}</span>
									        	</a>
									        @else
										        {{'Chưa chỉ định'}}
									        @endif
								        </td>
								        <td>{{$khoa->soLuongCB}}</td>
								        <td>
								        	@if($khoa->ctdt)
									        	@if(count($khoa->ctdt) === 1 && count($khoa->ctdt[0]->_ctdt) === 1)
										        	{{$khoa->ctdt[0]->hdt.' '.$khoa->ctdt[0]->_ctdt[0]}}
									        	@else
										        	@foreach($khoa->ctdt as $ctdt)
										        	<ul class="nav">
														<li>
															<a data-a-ctdt><span class="fa fa-chevron-down"></span> $ctdt->hdt (count($ctdt->_ctdt))</a>
															<ul class="nav _child_menu">
																@foreach($ctdt->_ctdt as $cth)
																	<li><a href="javascript:void(0)">$cth</a></li>
																@endforeach
															</ul>
														</li>
													</ul>
													@endforeach
												@endif
											@else
												{{'Chưa có chương trình đào tạo nào'}}
											@endif			
								        </td>
								        <td>
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maKhoa="{{$khoa->idKhoa}}" data-button-tenKhoa="{{$khoa->tenKhoa}}"><i class="glyphicon glyphicon-edit"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maKhoa="{{$khoa->idKhoa}}" data-button-tenKhoa="{{$khoa->tenKhoa}}"><i class="glyphicon glyphicon-trash"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách bộ môn" data-button-id="xemDanhSachBM" data-button-maKhoa="{{$khoa->idKhoa}}" data-button-tenKhoa="{{$khoa->tenKhoa}}"><i class="fa fa-list"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xem danh sách cán bộ" data-button-id="xemDanhSachCBK" data-button-maKhoa="{{$khoa->idKhoa}}" data-button-tenKhoa="{{$khoa->tenKhoa}}"><i class="fa fa-male"></i></button>
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
@endsection
@section('specifiedScript')
<!-- Các hàm dùng chung trong project -->
@include('js.common')
<!-- Khởi tạo side bar -->
@include('js.khoi_tao_side_bar')
<!-- Khởi tạo Form validate -->
@include('js.khoi_tao_form_validator')
<!-- Khởi tạo các chức năng thanh công cụ menu -->
@include('js.thanh_cong_cu_menu')
<!-- Khởi tạo data table -->
@include('admin.js.ql_khoa__bo_mon.0_khoi_tao_dataTable_khoa__bo_mon')
<!-- Khởi tạo sự kiện check record table -->
@include('admin.js.ql_khoa__bo_mon.1_checkbox_table_khoa__bo_mon')
<!-- Khởi tạo sự kiện click nút mở form thông tin khoa -->
@include('admin.js.ql_khoa__bo_mon.2_nut_them_khoa')
<!-- Khởi tạo sự kiện clcik cập nhật / thêm mới khoa -->
@include('admin.js.ql_khoa__bo_mon.3_nut_cap_nhat_tren_table')
<!-- Khởi tạo sự kiện click nút đóng form thông tin khoa -->
@include('admin.js.ql_khoa__bo_mon.4_nut_huy_tren_form')
<!-- Khởi tạo sự kiện click nút mở danh sách bộ môn -->
@include('admin.js.ql_khoa__bo_mon.5_nut_mo_danh_sach_bo_mon')
<!-- Khởi tạo sự kiện click nút mở danh sách cán bộ -->
@include('admin.js.ql_khoa__bo_mon.6_nut_mo_danh_sach_can_bo')
<!-- Khởi tạo sự kiện click mở form thông tn bộ môn -->
@include('admin.js.ql_khoa__bo_mon.7_nut_them_bo_mon')
<!-- Khởi tạo sự kiện click nút đóng danh sách bộ môn -->
@include('admin.js.ql_khoa__bo_mon.8_nut_dong_danh_sach_BM')
<!-- Khởi tạo sự kiện click nút cập nhật trên form -->
@include('admin.js.ql_khoa__bo_mon.9_nut_cap_nhat_tren_form')
<!-- Khởi tạo sự kiện click nút xoá trên table -->
@include('admin.js.ql_khoa__bo_mon.10_nut_xoa_tren_table')
<!-- Khởi tạo sự kiện click nút xoá trên danh sách -->
@include('admin.js.ql_khoa__bo_mon.11_nut_xoa_tren_ds')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection