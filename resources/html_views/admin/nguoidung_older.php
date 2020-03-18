@extends('admin.layout')

@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - QUẢN LÝ NGƯỜI DÙNG | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
@endsection

@section('css')
<!-- Datatables -->
<link href="resources/bootstraps/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/bootstraps/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/bootstraps/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet" media="all">
<link href="resources/css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet" media="all">
@endsection

@section('content')
<div class="">
	<div class="row">
		<!-- Modal cấp quyền và xem quyền hạn người dùng -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title">Quyền hạn chi tiết của người dùng</h4>
                </div>
                <div class="modal-body" style="overflow-y: hidden;">
                	<table class="table table-hover">
                      	<thead class="text-center" style="vertical-align: middle;">
                        	<tr>
	                          	<th rowspan="2" style="vertical-align: middle;">#</th>
	                          	<th class="text-center" rowspan="2" style="vertical-align: middle;">Cấp quyền</th>
	                          	<th class="text-center" rowspan="2" style="vertical-align: middle;">Tên quyền</th>
	                          	<th class="text-center" rowspan="2" style="vertical-align: middle;">Mô tả</th>
	                          	<th class="text-center" rowspan="2" style="vertical-align: middle;">Loại quyền</th>
	                          	<th colspan="4" class="text-center">Thao tác</th>
                        	</tr>
                        	<tr>
	                          	<th class="text-center">Thêm</th>
	                          	<th class="text-center">Xoá</th>
	                          	<th class="text-center">Cập nhật</th>
	                          	<th class="text-center">Sao chép</th>
                        	</tr>
                      	</thead>
                      	<tbody id="tbody__id__quyenChiTiet">
                      		@php $countQuyen = 0; @endphp
                      		@foreach(App\Functions\comm_functions::getDanhSachQuyen($nd) as $quyen)
                        	<tr>
                  				<th scope="row">{{ ++$countQuyen }}</th>
                  				<td class="text-center"><input type="checkbox" data-checkbox-id="checkbox__id__chkCapQuyen" data-checkbox-primary="" data-checkbox-content="{{ $quyen->IdQuyen }}"></td>
                  				<td>{{ $quyen->TenQH }}</td>
                  				<td>{{ $quyen->MoTa }}</td>
                  				<td data-td-id="{{ $quyen->IdQuyen }}" class="text-center"></td>
                  				<td class="text-center"><input type="checkbox" data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Them" data-checkbox-code="them" data-checkbox-content="{{ $quyen->IdQuyen }}"></td>
                  				<td class="text-center"><input type="checkbox" data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_Xoa" data-checkbox-code="xoa" data-checkbox-content="{{ $quyen->IdQuyen }}"></td>
                  				<td class="text-center"><input type="checkbox" data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_CapNhat" data-checkbox-code="capnhat" data-checkbox-content="{{ $quyen->IdQuyen }}"></td>
                  				<td class="text-center"><input type="checkbox" data-checkbox-id="checkbox__id__chkCapQuyenChiTiet_SaoChep" data-checkbox-code="saochep" data-checkbox-content="{{ $quyen->IdQuyen }}"></td>
                			</tr>
                			@endforeach
                      	</tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>

        <!-- Form cập nhật người dùng -->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__formNguoiDung" style="display: none;">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2>THÔNG TIN NGƯỜI DÙNG</h2>
			        <ul class="nav navbar-right panel_toolbox">
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		        	<form class="form-horizontal form-label-left" novalidate>
		          		<div class="item form-group" id="div__id__maCanBoArea">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Mã /Tên người dùng</label>
		           			<div class="col-md-6 col-sm-6 col-xs-12">
		           				<input type="text" class="form-control col-md-7 col-xs-12" id="textbox__id__maCanBo" readonly="">
		            		</div>
		          		</div>
		          		<div class="item form-group">
		            		<label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		              			<input type="text" class="form-control col-md-7 col-xs-12" readonly="" id="textbox__id__email">
		            		</div>
		          		</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
			            	<div class="col-md-6 col-sm-6 col-xs-12" style="padding: 8px 10px 0px">
			            		<div class="col-sm-2">
			            			<div style="float: left; width: 100%; margin-bottom: 10px">
				            			<input style="float: left; margin-right: 7px" type="radio" name="gioiTinh" disabled id="radio__id__gtNam"><span style="float: left; line-height: 2;font-size: 13px;"> Nam</span>
				            		</div>
			            		</div>
			            		<div class="col-sm-2">
				              		<div style="float: left; width: 100%; margin-bottom: 10px">
				              			<input style="float: left; margin-right: 7px" type="radio" name="gioiTinh" disabled id="radio__id__gtNu"><span style="float: left; line-height: 2;font-size: 13px;"> Nữ</span>
				              		</div>
				              	</div>
		            		</div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Nghiệp vụ</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12" id="div__id__nghiepVu"></div>
			          	</div>
			          	<div class="item form-group">
			            	<label class="control-label col-md-3 col-sm-3 col-xs-12">Quyền mặc định</label>
		            		<div class="col-md-6 col-sm-6 col-xs-12">
		            			<input type="text" class="form-control col-md-7 col-xs-12" readonly="" id="textbox__id__quyenMacDinh">
		            		</div>
		            		<div class="col-md-3 col-sm-3 col-xs-12">
		            			<button type="button" class="btn btn-sm btn-info" id="button__id__quyenPhu" rel="tooltip" data-placement="top" data-original-title="Chỉnh sửa các quyền khác" data-toggle="modal">
		            				<i class="glyphicon glyphicon-link"></i>
		            			</button>
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
				              	<button type="button" class="btn btn-danger" rel="tooltip" data-placement="top" data-original-title="Huỷ" id="button__id__huy">
				              		<i class="glyphicon glyphicon-remove"></i>
				              	</button>
				              	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Cập nhật" id="button__id__capNhat">
				              		<i class="glyphicon glyphicon-ok"></i>
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
		  			<div class="row">
		  				<div class="col-sm-12" id="div__id__xoaCacNguoiDungDaChonArea" hidden="">
		  					<button type="button" id="button__id__xoaCacNguoiDung" data-toggle="tooltip" data-placement="top" data-original-title="Xoá các người dùng đã chọn" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
		  				</div>
		  				<div class="col-sm-12">
							<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
					      		<thead>
					        		<tr>
							          	<th><input type="checkbox" id="checkbox__id__dtb_user_chkAll"></th>
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
							    	@if(isset($users))
								    	@php $count = 0; @endphp
								    	@php for($jj = 0; $jj < 1; ++$jj){ @endphp
								    	@foreach($users as $user)
								    		@if(is_object($user->canBoGiangVienNguoiDung))
								    <tr>
								        <td>
											<input type="checkbox" data-checkbox-content="{{ $user->idUser }}" data-checkbox-content-name="{{ $user->usersVsCanBo->canBo->HoTen }}" data-checkbox-id="checkbox__data-checkbox-id__dtb_user_chk">
										</td>
								        <td>{{ $user->usersVsCanBo->canBo->HoTen }}</td>
								        <td>{{ $user->email }}</td>
								        <td>
								        	@if(($count = count(App\Functions\comm_functions::getQuyenUser($user))) > 0) 
								        		@foreach(App\Functions\comm_functions::getQuyenUser($user) as $quyen) 
								        			@php --$count; @endphp
								        			@if($quyen['quyenChinh']) 
								        				@if(!$count) 
								        					{{$quyen['thongTinQuyen']['TenQH'].' (chính)'}} 
								        				@else
								        					{{$quyen['thongTinQuyen']['TenQH'].' (chính), '}} 
							        					@endif 
						        					@elseif(!$count) 
						        						{{ $quyen['thongTinQuyen']['TenQH'] }} 
					        						@else 
					        							{{ $quyen['thongTinQuyen']['TenQH'].', ' }} 
				        							@endif 
				        						@endforeach 
			        						@endif
								        </td>
								        <td>{{ date('d/m/Y h:m:s A', strtotime($user->created_at))}}</td>
								        <td>{{ date('d/m/Y h:m:s A', strtotime($user->updated_at))}}</td>
								        <td>{{ number_format($user->SoLanDangNhap) }}</td>
								        <td>{{ date('d/m/Y h:m:s A', strtotime($user->DangNhapLC))}}</td>
								        <td>{{ $user->TrangThai ? "Đăng nhập" : "Đăng xuất" }}</td>
								        <td>
								        	@if(is_object($user->usersVsCanBo))
								        		@if(is_object($user->usersVsCanBo->canBo))
								        	<div class="btn-group">
					                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Sửa" data-button="sua" data-button-id="{{ $user->idUser }}" data-button-email="{{ $user->email }}" data-button-gioitinh="{{ $user->usersVsCanBo->canBo->GioiTinh }}" data-button-congviec="{{ $user->usersVsCanBo->canBo->CongViec }}" data-button-anh="@if($user->usersVsCanBo->canBo->Anh) {{ $user->usersVsCanBo->canBo->Anh }} @else {{ 'khong_co' }} @endif"><i class="glyphicon glyphicon-edit"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Xoá" data-button="xoa" data-button-id="{{ $user->idUser }}"><i class="glyphicon glyphicon-trash"></i></button>
					                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="modal" rel="tooltip" data-original-title="Xem các quyền hạn chi tiết" data-button-id="xemQuyenCT" data-button-content="{{ $user->idUser }}"><i class="glyphicon glyphicon-info-sign"></i></button>
					                            <input type="hidden" data-hidden-flag="hidden__data-hidden-flag__quyen" data-hidden-id="{{ $user->idUser }}" data-hidden-content="@if(($count = count(App\Functions\comm_functions::getQuyenUser($user))) > 0) @foreach(App\Functions\comm_functions::getQuyenUser($user) as $quyen) @php --$count; @endphp @if(!$count) {{$quyen['capQuyen']['IdQuyen'].','.$quyen['thongTinQuyen']['TenQH'].','.$quyen['thongTinQuyen']['MoTa'].','.$quyen['capQuyen']['ThaoTac'].','.$quyen['quyenChinh']}} @else {{$quyen['capQuyen']['IdQuyen'].','.$quyen['thongTinQuyen']['TenQH'].','.$quyen['thongTinQuyen']['MoTa'].','.$quyen['capQuyen']['ThaoTac'].','.$quyen['quyenChinh'].';'}} @endif @endforeach @endif">
					                            <input type="hidden" data-hidden-flag="hidden__data-hidden-flag__chucVu" data-hidden-id="{{ $user->idUser }}" data-hidden-content="@if(($count = count($user->usersVsCanBo->canBo->chucVuVsCanBo)) > 0) @foreach($user->usersVsCanBo->canBo->chucVuVsCanBo as $chucVu) @php --$count; @endphp @if(!$count) {{ $chucVu->chucVu->TenCV}} @else {{ $chucVu->chucVu->TenCV.'|' }} @endif @endforeach @else {{'khong_co'}} @endif">
				                          	</div>
						                        @endif
					                        @endif
					                    </td>
								    </tr>
								    		@elseif(is_object($user->sinhVienNguoiDung))
								    		@php $count = 0; @endphp
								    	@endforeach
								    	@php } @endphp
							    	@endif
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
<!-- FastClick -->
<script src="resources/js/fastclick/lib/fastclick.js"></script>
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
<script src="resources/js/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="resources/js/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="resources/js/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="resources/bootstraps/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="resources/js/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="resources/bootstraps/jszip/dist/jszip.min.js"></script>
<script src="resources/js/pdfmake/build/pdfmake.min.js"></script>
<script src="resources/js/pdfmake/build/vfs_fonts.js"></script>
@endsection

@section('specifiedScript')
	@include('admin.JS.JS_nguoi_dung')
@endsection