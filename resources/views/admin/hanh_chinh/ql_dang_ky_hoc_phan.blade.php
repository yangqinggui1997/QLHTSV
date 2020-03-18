@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ NGƯỜI DÙNG | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
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
		<!-- Form cập nhật người dùng -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formNguoiDung" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2>THÔNG TIN NGƯỜI DÙNG</h2>
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
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Mã /Tên người dùng</label>
		           			<div class="col-md-6 col-sm-6 col-xs-12">
		           				<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__maCanBo" list="datalist__id__maCanBo" required placeholder="Trần Văn A - CB111">
		           				<datalist id="datalist__id__maCanBo">
		           					@foreach($danhSachCB as $canBo)
		           					<option data-option-loaiND="cb" value="{{$canBo->idCB}}">{{$canBo->hoTen}}</option>
		           					@endforeach
		           					@foreach($danhSachSV as $sinhVien)
		           					<option data-option-loaiND="sv" value="{{$sinhVien->idSV}}">{{$sinhVien->hoTen}}</option>
		           					@endforeach
		           				</datalist>
		           				<input type="hidden" id="hidden__id__maCanBo">
		            		</div>
		          		</div>
		          		<div class="item form-group">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		              			<input type="text" class="form-control col-md-7 col-xs-12" readonly="" id="textBox__id__email">
		            		</div>
		          		</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12">
			            		<input class="form-control col-md-7 col-xs-12" id="textBox__id__gioiTinh" readonly>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Nghiệp vụ</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input class="form-control col-md-7 col-xs-12" id="textBox__id__nghiepVu" readonly>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Quyền hạn</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input class="form-control col-md-7 col-xs-12" id="textBox__id__quyen" readonly>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<textarea class="form-control col-md-7 col-xs-12" id="textarea__id__moTa" readonly></textarea>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Thao tác</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<table class="table table-striped table-bordered" style="margin-bottom: 0">
			                      	<thead>
			                        	<tr>
				                          	<th>Thêm</th>
				                          	<th>Xoá</th>
				                          	<th>Cập nhật</th>
				                          	<th>Sao chép</th>
			                        	</tr>
			                      	</thead>
			                      	<tbody id="tbody__id__quyenChiTiet">
			                        	<tr>
			                  				<td data-td-capQuyen><input type="checkbox" data-checkbox-capQuyenCT data-checkbox-id="checkBox__id__chkCapQuyenChiTiet_Them" data-checkbox-code="them" data-checkbox-content="mã quyền"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-capQuyenCT data-checkbox-id="checkBox__id__chkCapQuyenChiTiet_Xoa" data-checkbox-code="xoa" data-checkbox-content="mã quyền"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-capQuyenCT data-checkbox-id="checkBox__id__chkCapQuyenChiTiet_CapNhat" data-checkbox-code="capnhat" data-checkbox-content="mã quyền"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-capQuyenCT data-checkbox-id="checkBox__id__chkCapQuyenChiTiet_SaoChep" data-checkbox-code="saochep" data-checkbox-content="mã quyền"></td>
			                			</tr>
			                      	</tbody>
			                    </table>
		            		</div>
		            	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12">
			            		<select class="form-control col-md-7 col-xs-12" id="select__id__trangThai">
			            			<option value="tu_do">Tự do</option>
			            			<option value="bi_khoa">Bị khoá</option>
			            		</select>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			          		<label class="control-label col-md-3 col-sm-3 col-xs-12">Ảnh đại diện</label>
				            <div class="col-md-6 col-sm-6 col-xs-12 text-center">
				              	<img width="70" id="img__id__anh">
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
		  			@if(is_numeric(strpos($nd->thaoTac, 'them')) && $nd->idQuyen === "master")
		  			<div class="btn-group marginBottom10" id="div__id__button_group_nguoiDung">
		  				<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Thêm một tài khoản" id="button__id__them"><i class="glyphicon glyphicon-plus"></i></button>
		  			</div>
		  			@endif
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__nguoiDung" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
							          	<th><input type="checkbox" id="checkBox__id__dtb_user_chkAll"></th>
							          	<th>#</th>
							          	<th>TÊN NGƯỜI DÙNG</th>
							          	<th>EMAIL</th>
							          	<th>QUYỀN HẠN</th>
							          	<th>NGÀY TẠO TÀI KHOẢN</th>
							          	<th>CẬP NHẬT LẦN CUỐI</th>
							          	<th width="5%">SỐ LẦN ĐĂNG NHẬP</th>
							          	<th>ĐĂNG NHẬP LẦN CUỐI</th>
							          	<th>TRẠNG THÁI</th>
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__nguoiDung">
							    	@php $i=0; @endphp
							    	@foreach($danhSachND as $nguoiDung)
								    <tr>
								        <td>
											<input type="checkbox" data-checkbox-maND="{{$nguoiDung->idUser}}" data-checkbox-tenND="{{($nguoiDung->canBoGiangVienNguoiDung ? $nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $nguoiDung->sinhVienNguoiDung->sinhVien->hoTen)}}" data-checkbox-index="{{$i}}" data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk">
										</td>
										<td>{{++$i}}</td>
								        <td>{{($nguoiDung->canBoGiangVienNguoiDung ? $nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $nguoiDung->sinhVienNguoiDung->sinhVien->hoTen)}}</td>
								        <td>{{$nguoiDung->email}}</td>
								        <td>{{$nguoiDung->quyenHanUser->tenQH}}</td>
								        <td>{{date('d/m/Y h:i:s A',strtotime($nguoiDung->created_at))}}</td>
								        <td>{{date('d/m/Y h:i:s A',strtotime($nguoiDung->updated_at))}}</td>
								        <td>{{$nguoiDung->soLanDangNhap}}</td>
								        <td>{{date('d/m/Y h:i:s A',strtotime($nguoiDung->dangNhapLC))}}</td>
								        <td><label data-label-maND="{{$nguoiDung->idUser}}" data-label-index="{{($i - 1)}}" data-label-trangThai="{{$nguoiDung->trangThai}}">{{(($nguoiDung->trangThai === 'dang_xuat') ? 'Đăng xuất' : (($nguoiDung->trangThai === 'dang_nhap') ? 'Đăng nhập' : 'Bị khoá'))}}</label></td>
								        <td>
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maND="{{$nguoiDung->idUser}}" data-button-tenND="{{($nguoiDung->canBoGiangVienNguoiDung ? $nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $nguoiDung->sinhVienNguoiDung->sinhVien->hoTen)}}" data-button-index="{{($i - 1)}}"><i class="glyphicon glyphicon-edit"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maND="{{$nguoiDung->idUser}}" data-button-tenND="{{($nguoiDung->canBoGiangVienNguoiDung ? $nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $nguoiDung->sinhVienNguoiDung->sinhVien->hoTen)}}" data-button-index="{{($i - 1)}}"><i class="glyphicon glyphicon-trash"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xem các quyền hạn chi tiết" data-button-id="xemQuyenCT" data-button-maND="{{$nguoiDung->idUser}}"  data-button-tenND="{{($nguoiDung->canBoGiangVienNguoiDung ? $nguoiDung->canBoGiangVienNguoiDung->canBoGiangVien->hoTen : $nguoiDung->sinhVienNguoiDung->sinhVien->hoTen)}}"><i class="fa fa-users"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Khoá tài khoản này" data-button-id="khoataikhoan" data-button-maND="{{$nguoiDung->idUser}}" data-button-index="{{($i - 1)}}"><i class="glyphicon glyphicon-lock"></i></button>
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
<script src="resources/js/jsForViews/common.js"></script>
<!-- Khởi tạo side bar -->
<script src="resources/js/jsForViews/khoi_tao_side_bar.js"></script>
<!-- Khởi tạo Form validate -->
<script src="resources/js/jsForViews/khoi_tao_form_validator.js"></script>
<!-- Khởi tạo các chức năng thanh công cụ menu -->
<script src="resources/js/jsForViews/thanh_cong_cu_menu.js"></script>
<!-- Khởi tạo data table -->
<script src="resources/js/jsForViews/admin/nguoi_dung/0_khoi_tao_dataTable_nguoi_dung.js"></script>
<!-- Khởi tạo sự kiện check record table -->
<script src="resources/js/jsForViews/admin/nguoi_dung/1_checkbox_table_nguoi_dung.js"></script>
<!-- Khởi tạo sự kiện clcik nút thêm mới một tài khoản -->
<script src="resources/js/jsForViews/admin/nguoi_dung/2_nut_them_nguoi_dung.js"></script>
<!-- Khởi tạo sự kiện click nút mở form cập nhật tài khoản -->
<script src="resources/js/jsForViews/admin/nguoi_dung/3_nut_cap_nhat_tren_table.js"></script>
<!-- Khởi tạo sự kiện click nút đóng form cập nhật / thêm mới tài khoản-->
<script src="resources/js/jsForViews/admin/nguoi_dung/4_nut_huy_tren_form.js"></script>
<!-- Khởi tạo sự kiện click vùng chứa check box sẽ trigger check của checkbox trên modal cấp quyền-->
<script src="resources/js/jsForViews/admin/nguoi_dung/5_checkbox_capQuyen.js"></script>
<!-- Khởi tạo sự kiện input datalist mã người dùng-->
<script src="resources/js/jsForViews/admin/nguoi_dung/6_input_datalist_ma_nguoi_dung.js"></script>
<!-- Khởi tạo sự kiện click nút cập nhật trên form người dùng-->
<script src="resources/js/jsForViews/admin/nguoi_dung/7_nut_cap_nhat_tren_form.js"></script>
<!-- Khởi tạo sự kiện click nút xoá-->
<script src="resources/js/jsForViews/admin/nguoi_dung/8_nut_xoa_tren_table.js"></script>
<!-- Khởi tạo sự kiện click nút xoá trên danh sách -->
<script src="resources/js/jsForViews/admin/nguoi_dung/9_nut_xoa_tren_ds.js"></script>
<!-- Khởi tạo sự kiện click nút khoá tài khoản trên table -->
<script src="resources/js/jsForViews/admin/nguoi_dung/10_nut_khoaTK_tren_table.js"></script>
<!-- Khởi tạo sự kiện click nút xem quyền chi tiết của người dùng-->
<script src="resources/js/jsForViews/admin/nguoi_dung/11_nut_xem_quyenCT.js"></script>
<!-- Khởi tạo sự kiện click nút khoá nhiều tài khoản-->
<script src="resources/js/jsForViews/admin/nguoi_dung/12_nut_khoaTK_tren_ds.js"></script>
<!-- Khởi tạo tooltip -->
<script src="resources/js/jsForViews/khoi_tao_tooltip.js"></script>
@endsection