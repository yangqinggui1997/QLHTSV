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
			        <ul class="nav navbar-right panel_toolbox" id="ul__id__plt">
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}" novalidate>
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
			                        		<th>cấp hết</th>
				                          	<th>Thêm</th>
				                          	<th>Xoá</th>
				                          	<th>Cập nhật</th>
				                          	<th>Sao chép</th>
			                        	</tr>
			                      	</thead>
			                      	<tbody id="tbody__id__quyenChiTiet">
			                        	<tr>
			                        		<td data-td-capQuyen><input type="checkbox" data-checkbox-pr></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-code="them"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-code="xoa"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-code="capnhat"></td>
			                  				<td data-td-capQuyen style="text-align: center;"><input type="checkbox" data-checkbox-code="saochep"></td>
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
		  			<div class="btn-group" id="div__id__button_group_nguoiDung">
		  				<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Thêm một tài khoản" id="button__id__them"><i class="glyphicon glyphicon-plus"></i></button>
		  			</div>
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__nguoiDung" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
					      		<thead>
					        		<tr>
							          	<th data-th-td><input type="checkbox" data-checkbox-user="p"></th>
							          	<th>#</th>
							          	<th>NGƯỜI DÙNG</th>
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
							    	@foreach($danhSachND as $i => $nguoiDung)
								    <tr>
								        <td data-th-td>
											<input type="checkbox" data-checkbox-maND="{{$nguoiDung->maND}}" data-checkbox-tenND="{{$nguoiDung->tenND}}" data-checkbox-user="c">
										</td>
										<td class="text-center">{{($i+1)}}</td>
								        <td class="text-center">
								        	<a href="javascript:void(0)">
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
								        <td class="text-center">{!!$nguoiDung->ngayCN!!}</td>
								        <td>{{$nguoiDung->soLanDN}}</td>
								        <td class="text-center">{!!$nguoiDung->dangNhapLC!!}</td>
								        <td>{{$nguoiDung->trangThai}}</td>
								        <td>
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maND="{{$nguoiDung->maND}}" data-button-tenND="{{$nguoiDung->tenND}}"><i class="glyphicon glyphicon-edit"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maND="{{$nguoiDung->maND}}" data-button-tenND="{{$nguoiDung->tenND}}"><i class="glyphicon glyphicon-trash"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Xem các quyền hạn chi tiết" data-button-id="xemQuyenCT" data-button-maND="{{$nguoiDung->maND}}"  data-button-tenND="{{$nguoiDung->tenND}}"><i class="fa fa-users"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Khoá tài khoản này" data-button-id="khoataikhoan" data-button-maND="{{$nguoiDung->maND}}"><i class="glyphicon glyphicon-lock"></i></button>
					                            <button class="btn btn-sm  btn-default" type="button" data-toggle="tooltip" data-original-title="Mở khoá tài khoản này" data-button-id="mktaikhoan" data-button-maND="{{$nguoiDung->maND}}"><i class="fa fa-unlock-alt"></i></button>
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
@include('admin.js.ql_nguoi_dung.0_khoi_tao_dataTable_nguoi_dung')
<!-- Khởi tạo sự kiện check record table -->
@include('admin.js.ql_nguoi_dung.1_checkbox_table_nguoi_dung')
<!-- Khởi tạo sự kiện clcik nút thêm mới một tài khoản -->
@include('admin.js.ql_nguoi_dung.2_nut_them_nguoi_dung')
<!-- Khởi tạo sự kiện click nút mở form cập nhật tài khoản -->
@include('admin.js.ql_nguoi_dung.3_nut_cap_nhat_tren_table')
<!-- Khởi tạo sự kiện click nút đóng form cập nhật / thêm mới tài khoản -->
@include('admin.js.ql_nguoi_dung.4_nut_huy_tren_form')
<!-- Khởi tạo sự kiện click vùng chứa check box sẽ trigger check của checkbox trên table cấp quyền -->
@include('admin.js.ql_nguoi_dung.5_checkbox_capQuyen')
<!-- Khởi tạo sự kiện input datalist mã người dùng -->
@include('admin.js.ql_nguoi_dung.6_input_datalist_ma_nguoi_dung')
<!-- Khởi tạo sự kiện click nút cập nhật trên form người dùng -->
@include('admin.js.ql_nguoi_dung.7_nut_cap_nhat_tren_form')
<!-- Khởi tạo sự kiện click nút xoá -->
@include('admin.js.ql_nguoi_dung.8_nut_xoa_tren_table')
<!-- Khởi tạo sự kiện click nút xoá trên danh sách -->
@include('admin.js.ql_nguoi_dung.9_nut_xoa_tren_ds')
<!-- Khởi tạo sự kiện click nút khoá tài khoản trên table -->
@include('admin.js.ql_nguoi_dung.10_nut_khoaTK_tren_table')
<!-- Khởi tạo sự kiện click nút xem quyền chi tiết của người dùng -->
@include('admin.js.ql_nguoi_dung.11_nut_xem_quyenCT')
<!-- Khởi tạo sự kiện click nút khoá nhiều tài khoản -->
@include('admin.js.ql_nguoi_dung.12_nut_khoaTK_tren_ds')
<!-- Khởi tạo sự kiện click nút mở khoá tài khoản trên danh sách -->
@include('admin.js.ql_nguoi_dung.13_nut_mo_khoa_tren_ds')
<!-- Khởi tạo sự kiện click nút mở khoá tài khoản trên table -->
@include('admin.js.ql_nguoi_dung.14_nut_mo_khoa_tren_table')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection