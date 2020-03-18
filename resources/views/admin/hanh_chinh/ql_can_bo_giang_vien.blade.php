@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ CÁN BỘ, GIẢNG VIÊN | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
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
		<!-- Danh sách phân công học phần cán bộ ... giảng dạy -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__danhSachHPGD" style="display: none">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2 id="h2__id__danhSachHPGD">Phân công giảng dạy cho Giảng viên [tengiangvien]</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="btn-group marginBottom10" id="div__id__button_group_hocPhanGD">
			  			<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Phân công các môn đã chọn cho Giảng viên" id="button__id__themHPGD"><i class="glyphicon glyphicon-ok"></i></button>
			  			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Đóng danh sách" id="button__id__dongDanhSachHPGD"><i class="glyphicon glyphicon-remove"></i></button>
		  			</div>
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__hocPhanGD" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
					      		<thead>
					        		<tr>
							          	<th><input type="checkbox" data-checkbox-pcgd="p"></th>
							          	<th>#</th>
							          	<th>mã học phần</th>
							          	<th>học phần</th>
							          	<th>nhóm môn học</th>
							          	<th>số tín chỉ</th>
							          	<th>số tiết lý thuyết</th>
							          	<th>số tiết thực hành</th>
							          	<th>hệ / ngành tham chiếu</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__hocPhanGD">
								    <tr>
								        <td>
											<input type="checkbox" data-checkbox-maHP="mã học phần" data-checkbox-tenHP="tên học phần" data-checkbox-pcgd="c">
										</td>
								        <td>1</td>
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>
								        <td></td>
								    </tr>
							    </tbody>
					    	</table>
		  				</div>
		  			</div>
		  		</div>
			</div>
		</div>
        <!-- Form cập nhật cán bộ -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formCanBo" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2>THÔNG TIN CÁN BỘ</h2>
			        <ul class="nav navbar-right panel_toolbox">
			        	<li><a class="close-link"><i class="fa fa-close"></i></a>
			    		</li>
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}" novalidate>
		          		<div class="item form-group">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Cán bộ / Giảng viên</label>
		           			<div class="col-md-6 col-sm-6 col-xs-12">
		           				<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__tenCB" required pattern="alphanumeric" placeholder="Trần Văn A">
		            		</div>
		          		</div>
		          		<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12" style="padding: 8px 10px 0px">
			            		<div class="row">
				            		<div class="col-sm-2">
				            			<input style="margin-top: 1.5px" type="radio" name="gioiTinh" id="radio__id__gtNam" checked><span style="vertical-align: super;"> Nam</span>
				            		</div>
				            		<div class="col-sm-2">
					              		<input style="margin-top: 1.5px" type="radio" name="gioiTinh" id="radio__id__gtNu"><span style="vertical-align: super;"> Nữ</span>
					              	</div>
			            		</div>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input type='number' min='0' class="form-control" required id="number__id__soDienThoai" placeholder="0345114935"/>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input type='text' class="form-control" required id="textBox__id__email" placeholder="duongthanhqui1997@gmail.com"/>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Học vị</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12">
		            			<select class="form-control" id="select__id__hocVi">
		           					<option value="cu_nhan">Cử nhân</option>
		           					<option value="thac_si">Thạc sĩ</option>
		           					<option value="tien_si">Tiến sĩ</option>
		           					<option value="pho_giao_su_tien_si">Phó giáo sư - Tiến sĩ</option>
		           					<option value="giao_su">Giáo sư</option>
		           					<option value="pho_giao_su">Phó giáo sư</option>
		           				</select>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Chuyên môn</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<select class="form-control" id="select__id__chuyenMon">
		           					<option value="cong_nghe_thong_tin">Công nghệ thông tin</option>
		           					<option value="he_thong_thong_tin">Hệ thống thông tin</option>
		           					<option value="ky_thuat_phan_mem">Kỹ thuật phần mềm</option>
		           					<option value="khoa_hoc_may_tinh">Khoa học máy tính</option>
		           					<option value="kinh_te_tai_chinh">Kinh tế tài chính</option>
		           					<option value="quan_tri_kinh_doanh">Quản trị kinh doanh</option>
		           					<option value="quan_tri_to_chuc_doanh_nghiep">Quản trị tổ chức - doanh nghiệp</option>
		           					<option value="nong_nhiep_tai_nguyen_thien_nhien">Nông nghiệp và tài nguyên thiên nhiên</option>
		           					<option value="ky_thuat_cong_nghiep_moi_truong">Kỹ thuật công nghiệp môi trường</option>
		           					<option value="van_hoa_du_lich">Văn hoá - Du lịch</option>
		           					<option value="luat_chinh_tri">Luật - Chính trị</option>
		           					<option value="su_phan">Sư phạm</option>
		           				</select>
		            		</div>
		            	</div>
		            	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Nghiệp vụ</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12">
		            			<select class="form-control" id="select__id__nghiepVu">
		           					<option value="hanh_chinh">Hành chính</option>
		           					<option value="giang_day">Giảng dạy</option>
		           				</select>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Chức vụ</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12">
		            			<select class="form-control" id="select__id__chucVu">
		            				<option value="khong_co">Không có</option>
		           					<option value="pho_truong_bo_mon">Phó trưởng bộ môn</option>
		           					<option value="truong_bo_mon">Trưởng bộ môn</option>
		           					<option value="pho_truong_phong">Phó trưởng phòng</option>
		           					<option value="truong_phong">Trưởng phòng</option>
		           					<option value="pho_truong_khoa">Phó trưởng khoa</option>
		           					<option value="truong_khoa">Trưởng khoa</option>
		           					<option value="pho_hieu_truong">Phó hiệu trưởng</option>
		           					<option value="hieu_truong">Hiệu trưởng</option>
		           				</select>
		            		</div>
			          	</div>
		            	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Phòng / Bộ môn</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input type="text" class="form-control col-md-7 col-xs-12" id="textBox__id__phong" list="datalist__id__phong" required placeholder="Công nghệ thông tin">
		           				<datalist id="datalist__id__phong">
		           					@foreach($dsPhong as $phong)
		           					<option value="{{$phong->idPhong}}">{{$phong->tenPhong}}</option>
		           					@endforeach
		           				</datalist>
		           				<input type="hidden" id="hidden__id__phong">
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Khoa</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input type='text' class="form-control" id="textBox__id__khoa" readonly/>
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
		<!-- Danh sách cán bộ -->
	  	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  	<div class="x_title">
			    	<h2>DANH SÁCH CÁN BỘ</h2>
			    	<ul class="nav navbar-right panel_toolbox">
			      		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			      		</li>
			    	</ul>
			    	<div class="clearfix"></div>
			  	</div>
		  		<div class="x_content" style="overflow-y: hidden;">
		  			<div class="btn-group marginBottom10" id="div__id__button_group_canBo">
		  				<button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Thêm một cán bộ" id="button__id__them"><i class="glyphicon glyphicon-plus"></i></button>
		  			</div>
		  			<div class="row">
		  				<div class="col-sm-12">
							<table id="table__id__canBo" class="table table-striped table-bordered bulk_action{{(is_bool(strpos($nd->thaoTac, 'saochep')) ? ' disabledSelect': '')}}">
					      		<thead>
					        		<tr>
							          	<th><input type="checkbox" data-checkbox-cb="p"></th>
							          	<th>#</th>
							          	<th>mã cán bộ</th>
							          	<th>CÁN BỘ</th>
							          	<th>GIỚI TÍNH</th>
							          	<th>SĐT</th>
							          	<th>EMAIL</th>
							          	<th>HỌC VỊ</th>
							          	<th>CHUYÊN MÔN</th>
							          	<th>NGHIỆP VỤ</th>
							          	<th>THAO TÁC</th>
							        </tr>
							    </thead>
							    <tbody id="tbody__id__canBo">
							    	@foreach($dsCB as $index => $cb)
								    <tr>
								        <td>
											<input type="checkbox" data-checkbox-maCB="{{$cb->idCB}}" data-checkbox-tenCB="{{$cb->hoTen}}" data-checkbox-cb="c">
										</td>
								        <td>{{($index + 1)}}</td>
								        <td>
								        	<a href="javascript:void(0)">
								        		<label>
								        			<div class="avatar-wrap{{$cb->classTT}}">
		                                                <div class="avatarTiny avatar-tiny">
		                                                    <img src="{{$cb->anh}}" alt="Ảnh cán bộ">
		                                                </div>
		                                            </div>
								        		</label>
								        		<br>
								        		<span style="line-height: unset;margin-top:2px">{{$cb->hoTen}}</span>
								        	</a>
								        </td>
								        <td>{{$cb->gioiTinh}}</td>
								        <td>{{$cb->soDienThoai}}</td>
								        <td>{{$cb->email}}</td>
								        <td>{{$cb->hocVi}}</td>
								        <td>{{$cb->chuyenMon}}</td>
								        <td>{{$cb->nghiepVu}}</td>
								        <td>
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Sửa" data-button-id="sua" data-button-maCB="{{$cb->idCB}}"><i class="glyphicon glyphicon-edit"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Xoá" data-button-id="xoa" data-button-maCB="{{$cb->idCB}}" data-button-tenCB="{{$cb->hoTen}}"><i class="glyphicon glyphicon-trash"></i></button>
					                            @if($cb->giangDay)
					                            <button class="btn btn-sm btn-default" type="button" data-toggle="tooltip" data-original-title="Phân công giảng dạy" data-button-id="phanCongGD" data-button-maCB="{{$cb->idCB}}"><i class="fa fa-suitcase"></i></button>
					                            @endif
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
@include('admin.js.ql_can_bo_giang_vien.0_khoi_tao_dataTable_CBGV')
<!-- Khởi tạo sự kiện check record table -->
@include('admin.js.ql_can_bo_giang_vien.1_checkbox_table_CBGV__PCGD')
<!-- Khởi tạo sự kiện clcik nút thêm mới một cán bộ -->
@include('admin.js.ql_can_bo_giang_vien.2_nut_them_CBGV')
<!-- Khởi tạo sự kiện click nút mở form cập nhật cán bộ -->
@include('admin.js.ql_can_bo_giang_vien.3_nut_cap_nhat_tren_table')
<!-- Khởi tạo sự kiện click nút đóng form cập nhật / thêm mới cán bộ -->
@include('admin.js.ql_can_bo_giang_vien.4_nut_huy_tren_form')
<!-- Khởi tạo sự kiện click nút mở danh sách phân công giảng dạy -->
@include('admin.js.ql_can_bo_giang_vien.5_nut_mo_bang_phan_cong_gd')
<!-- Khởi tạo sự kiện click nút đóng danh sách phân công giảng dạy -->
@include('admin.js.ql_can_bo_giang_vien.6_nut_dong_danh_sach_pcgd')
<!-- Khởi tạo sự kiện click nút cập nhật trên form cán bộ -->
@include('admin.js.ql_can_bo_giang_vien.7_nut_cap_nhat_tren_form')
<!-- Khởi tạo sự kiện click nút xoá trên table-->
@include('admin.js.ql_can_bo_giang_vien.8_nut_nut_xoa_tren_table')
<!-- Khởi tạo sự kiện click nút xoá trên danh sách -->
@include('admin.js.ql_can_bo_giang_vien.9_nut_xoa_tren_ds')
<!-- Khởi tạo sự kiện input datalist mã phòng ban -->
@include('admin.js.ql_can_bo_giang_vien.10_datalist_pb')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection