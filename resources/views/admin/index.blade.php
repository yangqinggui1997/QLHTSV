@extends('admin.layout')
@section('title')
  {{ "KHU VỰC QUẢN TRỊ VIÊN - TRANG CHỦ | HỆ THỐNG QUẢN LÝ HỌC TẬP SINH VIÊN" }}
@endsection
@section('css')
<!-- nếu có form đăng ký thì liên kết -->
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
        <!-- Thông báo cấp trường-->
	  	<div class="col-md-12 col-sm-12 col-xs-12" id="div__id__thongBaoTruong">
		    <div class="x_panel">
		      	<div class="x_title">
			        <h2>THÔNG BÁO TRƯỜNG</h2>
			        <ul class="nav navbar-right panel_toolbox">
			        	<li><a class="close-link"><i class="fa fa-close"></i></a>
			        	</li>
			          	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          	</li>
			        </ul>
			        <div class="clearfix"></div>
		      	</div>
		    	<div class="x_content">
		    		@if(isset($loi))
		    		<div class="alert alert-danger alert-dismissible fade in" role="alert" style="text-shadow: none;">
		                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		                </button>
		                {{$loi}}
	                </div>
		    		@else
		    		@php $c = 0; $c1 = 0; @endphp
		    		@foreach($dsTB as $i => $tb)
		    		@if($i)
		        	<div class="anounce-seperate"></div>
		        	@endif
		        	<div class="row">
		        		<div class="col-sm-1 col-md-1 col-xs-1 reponsiveImg" data-toggle="tooltip" data-original-title="{{$tb->nguoiDung->gioiThieu}}">
		        			<div class="avatar-wrap{{$tb->nguoiDung->classTT}}">
                                <div class="avatar avatar--small">
                                    <img src="{{$tb->nguoiDung->anh}}" alt="Ảnh người dùng">
                                </div>
                            </div>
		        		</div>
		        		<div class="col-sm-11 col-md-11 col-xs-11">
		        			<div class="row">
		        				<div class="col-sm-10 col-md-10 col-xs-10">
		        					<label class="anounce-title">{{$tb->tieuDe}}</label>
		        				</div>
		        				<div class="col-sm-2 col-md-2 col-xs-2">
		        					<label class="anounce-time">{{$tb->ngayTao}}</label>
		        				</div>
		        			</div>
		        			<div class="row">
		        				<div class="col-sm-12 col-md-12 col-xs-12">
		        					<label class="anounce-content">{{$tb->noiDung}}</label>
		        				</div>
		        			</div>
		        			@php $c = count($tb->fileBM); $c1 = count($tb->fileVB); @endphp
		        			@if($c && !$c1)
		        				<div class="row">
			        				<div class="col-sm-1 col-md-1 col-xs-1">
			        					<label style="padding-top: 10px">Tập tin: </label>
			        				</div>
			        				<div class="col-sm-11 col-md-11 col-xs-11">
			        					@if($c === 1)
				        				<label style="padding-top: 10px"><a target="_blank" href="resources/files/{{$tb->fileBM[0]->file}}" style="margin-top: 10px">{{$tb->fileBM[0]->tenBM}} (Biểu mẫu)</a></label>
				        				@else
				        				<ul class="nav chmenu">
										  <li>
										  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu ({{$c}})</a>
										    <ul class="nav _child_menu" style="display:none;">
				        					@foreach($tb->fileBM as $fbm)
				        						<li><a target="_blank" href="resources/files/{{$fbm->file}}">{{$fbm->tenBM}}</a></li>
				        					@endforeach
										    </ul>
										  </li>
										</ul>
										@endif
			        				</div>
			        			</div>
							@elseif(!$c && $c1)
								<div class="row">
			        				<div class="col-sm-1 col-md-1 col-xs-1">
			        					<label style="padding-top: 10px">Tập tin: </label>
			        				</div>
			        				<div class="col-sm-11 col-md-11 col-xs-11">
			        				@if($c1 === 1)
			        				<label style="padding-top: 10px"><a target="_blank" href="resources/files/{{$tb->fileVB[0]->file}}">{{$tb->fileVB[0]->tenVB}} (Văn bản)</a>
			        				</label>
			        				@else
			        				<ul class="nav chmenu">
									  <li>
									  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản ({{$c1}})</a>
									    <ul class="nav _child_menu" style="display:none;">
			        					@foreach($tb->fileVB as $fvb)
			        						<li><a target="_blank" href="resources/files/{{$fvb->file}}">{{$fvb->tenVB}}</a></li>
			        					@endforeach
									    </ul>
									  </li>
									</ul>
									@endif
									</div>
								</div>
							@elseif($c && $c1)
								<div class="row">
			        				<div class="col-sm-1 col-md-1 col-xs-1">
			        					<label style="padding-top: 10px">Tập tin: </label>
			        				</div>
			        				<div class="col-sm-11 col-md-11 col-xs-11">
										<ul class="nav chmenu">
										  <li>
										  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Biểu mẫu ({{$c}})</a>
										    <ul class="nav _child_menu" style="display:none;">
				        					@foreach($tb->fileBM as $fbm)
				        						<li><a target="_blank" href="resources/files/{{$fbm->file}}">{{$fbm->tenBM}}</a></li>
				        					@endforeach
										    </ul>
										  </li>
										</ul>
										@php $c = count($tb->fileVB); @endphp
										<ul class="nav chmenu">
										  <li>
										  	<a data-a-propdownUF href="javascript:void(0)"><span class="fa fa-chevron-down"></span> Văn bản ({{$c1}})</a>
										    <ul class="nav _child_menu" style="display:none;">
				        					@foreach($tb->fileVB as $fvb)
				        						<li><a target="_blank" href="resources/files/{{$fvb->file}}">{{$fvb->tenVB}}</a></li>
				        					@endforeach
										    </ul>
										  </li>
										</ul>
									</div>
								</div>
							@endif
		        			@if(count($tb->bieuMauXML))
		        			<div class="row" style="margin-top: 10px;">
		        				<div class="col-sm-1 col-md-1 col-xs-1">
		        					<label>Đăng ký:</label>
		        				</div>
		        				<div class="col-sm-11 col-md-11 col-xs-11">
		        					<div class="btn-group">
		        						@foreach($tb->bieuMauXML as $bm)
			        					<button type="button" class="btn btn-large btn-success" data-button-id="dangKy" data-button-maBM="{{$bm->idBM}}" data-button-tenTB="{{$tb->tieuDe}}" data-toggle="tooltip" data-original-title="{{$bm->tieuDe}}">
			        						<i class="fa fa-plus"></i>
			        					</button>
			        					@endforeach
		        					</div>
		        				</div>
		        			</div>
		        			@endif
		        		</div>
		        	</div>
		        	@endforeach
		        	@endif
		      	</div>
		    </div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<!-- validator -->
<script src="resources/bootstraps/validator/validator.js"></script>
<!-- nếu có form đăng ký thì liên kết -->
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
<!-- Khởi tạo Form validate -->
@include('js.khoi_tao_form_validator')
<!-- Khởi tạo các chức năng thanh công cụ menu -->
@include('js.thanh_cong_cu_menu')
<!-- Khởi tạo sự kiện click nút mở form đăng ký -->
@include('admin.js.index.0_mo_form_dang_ky')
<!-- Khởi tạo tooltip -->
@include('js.khoi_tao_tooltip')
@endsection