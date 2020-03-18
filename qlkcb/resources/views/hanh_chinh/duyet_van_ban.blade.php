@extends('hanh_chinh.layout')

@section('title')
    {{ "Duyệt văn bản" }}
@endsection

@section('css')
<style type="text/css">
    textarea {
       resize: none;
    }
</style>
@endsection

@section('content')
    <div class="main-content">
        <input type="hidden" id="id_nv" value="{{$nd->nhanVien->IdNV}}">
        <?php $flag=FALSE;?>
        @foreach($nd->capQuyen as $cqnd)
            @if($cqnd->Quyen == 'khth')
            <input type="hidden" id="quyen_bs" value="TRUE">
            <?php $flag=TRUE; break;?>
            @endif  
        @endforeach
        @if(($flag==FALSE && $nd->Quyen =='qlbv') || count($nd->capQuyen) > 0)
        <?php $flag='YES';?>
        <input type="hidden" id="quyen_bs" value="FALSE">
        @else
        <input type="hidden" id="quyen_bs" value="FK">
        @endif
                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    @if($flag == TRUE || $flag == 'YES')
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH VĂN BẢN</h3>
                                    @else
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH VĂN BẢN ĐÃ ĐƯỢC DUYỆT</h3>
                                    @endif
                                    <hr class="line-seprate">
                                </div>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="au-breadcrumb-content">
                                            <div class="au-breadcrumb-left">
                                            </div>
                                            <form class="au-form-icon--sm" id="ftimkiem" >
                                                <input type="text" class="au-input--w300 au-input--style2" id="txttimkiem" placeholder="Nhập thông tin cần tìm...">
                                                <button type="button" class="au-btn--submit2" data-toggle="tooltip" title="Tìm kiếm" id="btntimkiem">
                                                    <i class="zmdi zmdi-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button type="button" class="au-btn au-btn--teal au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Nạp lại danh sách" id="btnnapds"><i class="zmdi zmdi-refresh"></i></button>
                                        <button class="au-btn au-btn--red au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Xóa các đối tượng đã chọn" id="btnxoatc"><i class="zmdi zmdi-delete"></i></button>
                                    </div>
                                </div>
                                <div class="table-data__tool">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <p class="color-redlight font-size-10" id="kqtimliem"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-data__tool hidden" id="tb_bc" style="margin-bottom: 0">
                                    <div class="table-data__tool-left" id="thong_bao">
                                        
                                    </div>
                                </div>
                                @if($flag == TRUE || $flag == 'YES')
                                <div class="custom-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                                             aria-selected="true">DANH SÁCH CHỜ DUYỆT</a>
                                            <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                                             aria-selected="false">DANH SÁCH ĐÃ DUYỆT</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                            <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                                <table class="table table-data2 table-hover m-b-20 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox" data-input="checksumCD">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <th style="position: sticky; top: 0; z-index: 99;">Chủ đề</th>
                                                            <th>Người gửi</th>
                                                            <th>Ngày gửi</th>
                                                            <th>Số file gửi</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_cd">
                                                        @if(isset($dscd))
                                                        @foreach($dscd as $cd)
                                                        <tr class="tr-shadow">
                                                            <td style="vertical-align: middle;">
                                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                    <input type="checkbox" data-input="check" data-id="{{ $cd->IdTK }}" data-name="{{ $cd->CD }}">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-left">{{$cd->CD}}</td>
                                                            <td class="text-left">
                                                                {{ $cd->nhanVien->TenNV }} - Phòng {{ $cd->nhanVien->phongBan->TenPhong }} ({{ $cd->nhanVien->phongBan->SoPhong }})
                                                            </td>
                                                            <td>{{ \comm_functions::deDateFormat($cd->created_at) }}</td>
                                                            <td class="text-right">{{ count($cd->File) }}</td>
                                                            <td>
                                                                <div class="table-data-feature">
                                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Duyệt" data-button="duyet" data-id="{{$cd->IdTK}}" 
                                                                        <?php $src='';$n=1; ?>
                                                                        @foreach($cd->File as $f)
                                                                            @if($n == count($cd->File))
                                                                            <?php $src.=$f->TenFile; ?>
                                                                            @else
                                                                            <?php $src.=$f->TenFile.'|'; ?>
                                                                            @endif
                                                                            <?php $n++;?>
                                                                        @endforeach
                                                                        data-src="{{ $src }}">
                                                                        <i class="fa fa-check"  ></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $cd->IdTK }}" data-name="{{ $cd->CD}}">
                                                                        <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                            <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                                <table class="table table-data2 table-hover m-b-20 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox" data-input="checksumDD">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <th style="position: sticky; top: 0; z-index: 99;">Chủ đề</th>
                                                            <th>Người gửi</th>
                                                            <th>Ngày gửi</th>
                                                            <th>Số file gửi</th>
                                                            <th>Ngày duyệt</th>
                                                            <th>Người duyệt</th>
                                                            <th>Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_dd">
                                                        @if(isset($dsdd))
                                                        @foreach($dsdd as $dd)
                                                        <tr class="tr-shadow">
                                                            <td style="vertical-align: middle;">
                                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                                    <input type="checkbox" data-input="check" data-id="{{ $dd->IdTK }}" data-name="{{ $dd->CD }}">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-left">{{$dd->CD}}</td>
                                                            <td class="text-left">
                                                                {{ $dd->nhanVien->TenNV }} - Phòng {{ $dd->nhanVien->phongBan->TenPhong }} ({{ $dd->nhanVien->phongBan->SoPhong }})
                                                            </td>
                                                            <td>{{ \comm_functions::deDateFormat($dd->created_at) }}</td>
                                                            <td>{{ count($dd->File) }}</td>
                                                            <td>
                                                                <?php
                                                                $ngayduyet=date('Y-m-d H:i:s');
                                                                    foreach($dd->duyetTK as $dt){
                                                                        $ngayduyet=$dt->created_at;
                                                                    }
                                                                    echo \comm_functions::deDateFormat($ngayduyet);
                                                                 ?></td>
                                                            <td class="text-left">
                                                                <?php
                                                                    foreach($dd->duyetTK as $d){
                                                                        $chucvu='';$cb='';$i=1;
                                foreach ($d->nhanVien->chucVu as $nvd) {
                                    if(count($d->nhanVien->chucVu) == 1){
                                        $chucvu=$nvd->chucVu->TenCV;
                                    }
                                    else{
                                        if($i == 1){
                                            $cb=$nvd->chucVu->CB;
                                            $chucvu=$nvd->chucVu->TenCV;
                                        }
                                        else{
                                            if($nvd->chucVu->CB > $cb){
                                                $cb=$nvd->chucVu->CB;
                                                $chucvu=$nvd->chucVu->TenCV;
                                            }
                                        }
                                        $i++;
                                    }
                                } 
                                if($i == count($dd->duyetTK)){
                                    echo '+ '.$d->nhanVien->TenNV.' - '.$chucvu.' [Phòng '.$d->nhanVien->phongBan->TenPhong.' ['.$d->nhanVien->phongBan->SoPhong.'])';
                                }
                                else{
                                    echo '+ '.$d->nhanVien->TenNV.' - '.$chucvu.' [Phòng '.$d->nhanVien->phongBan->TenPhong.' ['.$d->nhanVien->phongBan->SoPhong.'])<br>';
                                }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="table-data-feature">
                                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="{{$dd->IdTK}}" 
                                                                        <?php $sr='';$k=1; ?>
                                                                        @foreach($dd->File as $f)
                                                                            @if($k == count($dd->File))
                                                                            <?php $sr.=$f->TenFile; ?>
                                                                            @else
                                                                            <?php $sr.=$f->TenFile.'|'; ?>
                                                                            @endif
                                                                            <?php $k++;?>
                                                                        @endforeach
                                                                        data-src="{{ $sr }}">
                                                                        <i class="fa fa-eye"  ></i>
                                                                    </button>
                                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $dd->IdTK }}" data-name="{{ $dd->CD}}">
                                                                        <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                        <table class="table table-data2 table-hover m-b-20 text-center">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <label class="au-checkbox">
                                                            <input type="checkbox" data-input="checksumDD">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <th style="position: sticky; top: 0; z-index: 99;">Chủ đề</th>
                                                    <th>Người gửi</th>
                                                    <th>Ngày gửi</th>
                                                    <th>Số file gửi</th>
                                                    <th>Ngày duyệt</th>
                                                    <th>Người duyệt</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_ddt">
                                                @if(isset($dsdd))
                                                @foreach($dsdd as $dd)
                                                <tr class="tr-shadow">
                                                    <td style="vertical-align: middle;">
                                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                            <input type="checkbox" data-input="check" data-id="{{ $dd->IdTK }}" data-name="{{ $dd->CD }}">
                                                            <span class="au-checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td class="text-left">{{$dd->CD}}</td>
                                                    <td class="text-left">
                                                        {{ $dd->nhanVien->TenNV }} - Phòng {{ $dd->nhanVien->phongBan->TenPhong }} ({{ $dd->nhanVien->phongBan->SoPhong }})
                                                    </td>
                                                    <td>{{ \comm_functions::deDateFormat($dd->created_at) }}</td>
                                                    <td>{{ count($dd->File) }}</td>
                                                    <td>
                                                    <?php
                                                    $ngayduyet=date('Y-m-d H:i:s');
                                                        foreach($dd->duyetTK as $dt){
                                                            $ngayduyet=$dt->created_at;
                                                        }
                                                        echo \comm_functions::deDateFormat($ngayduyet);
                                                     ?></td>
                                                    <td class="text-left">
                                                        <?php
                                                            foreach($dd->duyetTK as $d){
                                                                $chucvu='';$cb='';$i=1;
                        foreach ($d->nhanVien->chucVu as $nvd) {
                            if(count($d->nhanVien->chucVu) == 1){
                                $chucvu=$nvd->chucVu->TenCV;
                            }
                            else{
                                if($i == 1){
                                    $cb=$nvd->chucVu->CB;
                                    $chucvu=$nvd->chucVu->TenCV;
                                }
                                else{
                                    if($nvd->chucVu->CB > $cb){
                                        $cb=$nvd->chucVu->CB;
                                        $chucvu=$nvd->chucVu->TenCV;
                                    }
                                }
                                $i++;
                            }
                        } 
                        if($i == count($dd->duyetTK)){
                            echo '+ '.$d->nhanVien->TenNV.' - '.$chucvu.' [Phòng '.$d->nhanVien->phongBan->TenPhong.' ['.$d->nhanVien->phongBan->SoPhong.'])';
                        }
                        else{
                            echo '+ '.$d->nhanVien->TenNV.' - '.$chucvu.' [Phòng '.$d->nhanVien->phongBan->TenPhong.' ['.$d->nhanVien->phongBan->SoPhong.'])<br>';
                        }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="{{$dd->IdTK}}" 
                                                                <?php $sr='';$k=1; ?>
                                                                @foreach($dd->File as $f)
                                                                    @if($k == count($dd->File))
                                                                    <?php $sr.=$f->TenFile; ?>
                                                                    @else
                                                                    <?php $sr.=$f->TenFile.'|'; ?>
                                                                    @endif
                                                                    <?php $k++;?>
                                                                @endforeach
                                                                data-src="{{ $sr }}">
                                                                <i class="fa fa-eye"  ></i>
                                                            </button>
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $dd->IdTK }}" data-name="{{ $dd->CD}}">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="spacer"></tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END DATA TABLE-->
                @if($nd->Quyen != 'admin')
                <!--MODAL DUYỆT VĂN BẢN-->
                <div class="modal fade" id="modaldvb" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lgest" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                @if($flag == TRUE || $flag == 'YES')
                                <h5 class="modal-title" id="largeModalLabel1">Xem và duyệt báo cáo</h5>
                                @else 
                                <h5 class="modal-title" id="largeModalLabel1">Xem báo cáo đã gửi</h5>
                                @endif
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Đóng">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body fit_table_height_500">
                                <div class="row" style="display: flex; align-items: center;">
                                    <div class="col-lg-1 text-right">
                                        <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" id="btnfiletruoc"><span class="fa fa-chevron-left"></span></button>
                                    </div>
                                    <div class="col-lg-10">
                                        <iframe frameBorder="0" id="framepdf" style="right:0; top:53px; bottom:0; height:400px; width:100%">
                                            
                                        </iframe>
                                        <div class="hidden text-center" id="framenone" style="right:0; top:53px; bottom:0; height:400px; width:100%;padding-top: 200px;">
                                            File không tồn tại!
                                        </div>
                                    </div>
                                    <div class="col-lg-1 text-left">
                                        <button type="button" class="au-btn au-btn--blue2 au-btn--small au-btn-shadow height-40px" id="btnfilesau"><span class="fa fa-chevron-right"></span></button>
                                    </div>
                                </div>
                                @if($flag == TRUE || $flag == 'YES')
                                <div class="row hidden m-t-10" id="dtbiarea">
                                    <div class="col-lg-12">
                                        <label style="font-weight: normal" id="dtbi">Đang xử lý!</label>
                                    </div>
                                </div>
                                <div class='row hidden' id="proccess">
                                    <div class='col-lg-12'>
                                        
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span>Vui lòng chờ<span class="dotdotdot" id="dot"></span></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1 text-right">
                                        
                                    </div>
                                    <div class="col-lg-10 m-t-10 text-center">
                                        <button type="button" class="au-btn au-btn--blue au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Duyệt" id="btnduyet"><span class="fa fa-check"></span></button>
                                    </div>
                                    <div class="col-lg-1 text-left">
                                        
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--END MODAL DUYỆT VĂN BẢN-->
                @endif
            </div>
@endsection

@section('js')
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false;
        //end

        var showTooltip = function () {
            $(this).tooltip('show');
        }
        , hideTooltip = function () {
            $(this).tooltip('hide');
        };

        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'manual'

        })
        .focus(hideTooltip)
        .blur(hideTooltip)
        .hover(showTooltip, hideTooltip);

        var CSRF_TOKEN = $('meta[name="_token"]').attr('content');

        //Phần xử lý cho channel
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('d2f4702dc798a781c566', {
            cluster: 'ap1',
            encrypted: true
        });

        var chaneltk = pusher.subscribe('UserEvent');

        function capnhattk(data) {
            if(data.thaotac == 'cntk'){
                $('img[data-anhtk="anhtk"]').attr('src', 'public/upload/anhnv/'+data.anh);
            }
        }

        chaneltk.bind('App\\Events\\Admin\\UserEvent', capnhattk);
        
        var audio='';
        $('a[class*="bctk"]').click(function(){
            $.ajax({
                url: 'http://localhost/qlkcb/public/audios/sound.mp3',
                type: 'GET',
                error: function()
                {

                    //not exists
                },
                success: function()
                {
                    // exists
                    audio.pause();
                }
            });
        });

        var channel = pusher.subscribe('DVB');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var ttdm='';
                if(data.thaotac == 'duyet'){
                    if(data.dvb.idnvd == $('#id_nv').val()){
                        if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                            var slht=$('span[class*="spantk"]').attr('data-slbc');
                            var slm=parseInt(slht)-1;
                            if(slm == 0){
                                $('span[class*="spantk"]').remove();
                                $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa báo cáo nào!');
                            }
                            else{
                                $('span[class*="spantk"]').text(slm);
                                $('span[class*="spantk"]').attr('data-slbc', slm);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                            }
                        }
                        else{
                            $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa báo cáo nào!');
                        }

                        ttdm='\n\
                        <tr class="tr-shadow">\n\
                            <td style="vertical-align: middle;">\n\
                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                    <input type="checkbox" data-input="check" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                    <span class="au-checkmark"></span>\n\
                                </label>\n\
                            </td>\n\
                            <td class="text-left">'+data.dvb.cd+'</td>\n\
                            <td class="text-left">'+data.dvb.nguoigui+'</td>\n\
                            <td>'+data.dvb.ngaygui+'</td>\n\
                            <td>'+data.dvb.sofile+'</td>\n\
                            <td>'+data.dvb.ngayduyet+'</td>\n\
                            <td class="text-left">'+data.dvb.nguoiduyet+'</td>\n\
                            <td>\n\
                                <div class="table-data-feature">\n\
                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                        <i class="zmdi zmdi-delete"></i>\n\
                                    </button>\n\
                                </div>\n\
                            </td>\n\
                        </tr>\n\
                        <tr class="spacer"></tr>';
                        $('#tbl_dd').prepend(ttdm);
                        
                        $('#tbl_cd tr').has('td div button[data-id="'+data.dvb.id+'"]').next('tr.spacer').remove();
                        $('#tbl_cd tr').has('td div button[data-id="'+data.dvb.id+'"]').remove();
                    }
                    else{
                        if(data.dvb.pl == 'thong_ke' && data.dvb.idnv ==$('#id_nv').val()){
                            ttdm='\n\
                            <tr class="tr-shadow">\n\
                                <td>\n\
                                    <label class="au-checkbox">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td class="text-left">'+data.dvb.cd+'</td>\n\
                                <td class="text-left">'+data.dvb.nguoigui+'</td>\n\
                                <td>'+data.dvb.ngaygui+'</td>\n\
                                <td>'+data.dvb.sofile+'</td>\n\
                                <td class="text-left">'+data.dvb.nguoiduyet+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                            $('#tbl_ddt').prepend(ttdm);

                            if($('#tb_bc').hasClass('hidden')){
                                $('#tb_bc').removeClass('hidden');

                                var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-success">Thông báo!</span> Thống kê ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                            else{
                                var tb='<div class="rs-select2--light _'+data.dvb.id+'">\n\
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">\n\
                                        <span class="badge badge-pill badge-success">Thông báo!</span> Thống kê ['+data.dvb.cd+'] đã được duyệt bởi '+data.dvb.nd+'<button type="button" data-ma="'+data.dvb.id+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                            <span aria-hidden="true">×</span></button>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>';

                                $('#thong_bao').append(tb);
                            }
                        }
                    }
                }
                else{
                    if(data.dvb.pl ==  'thong_ke' || (data.dvb.pl ==  'grv' && $('#quyen_bs').val() == 'TRUE')){
                        if($('[class*="anounttk"]').find('[class*="noti-wrap"]').length > 0){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)+1;
                                $('span[class*="spantk"]').text(slm);
                                $('span[class*="spantk"]').attr('data-slbc', slm);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                            }
                            else{
                                var ct='<span class="quantity spantk">1</span>';
                                $('a[class*="bctk"]').append(ct);
                                $('span[class*="spantk"]').attr('data-slbc', 1);
                                $('a[class*="bctk"]').attr('data-original-title', 'Có 1 báo cáo chờ duyệt!');
                            }

                            $.ajax({
                                url: 'http://localhost/qlkcb/public/audios/sound.mp3',
                                type: 'GET',
                                error: function()
                                {
                                    //not exists
                                },
                                success: function()
                                {
                                    // exists
                                    audio = new Audio('public/audios/sound.mp3');
                                    audio.play();
                                }
                            });
                            
                            ttdm='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td class="text-left">'+data.dvb.cd+'</td>\n\
                                <td class="text-left">'+data.dvb.nguoigui+'</td>\n\
                                <td>'+data.dvb.ngaygui+'</td>\n\
                                <td class="text-right">'+data.dvb.sofile+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Duyệt" data-button="duyet" data-id="'+data.dvb.id+'" data-src="'+data.dvb.src+'">\n\
                                            <i class="fa fa-check"  ></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.dvb.id+'" data-name="'+data.dvb.cd+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                            $('#tbl_cd').prepend(ttdm);
                            $('button[data-id="'+data.dvb.id+'"]').tooltip({
                                trigger: 'manual'

                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                        }
                    }
                }
            }
            else{
                if($.isArray(data.dvb)){
                    if($('#quyen_bs').val() == 'FK'){
                        for (var i = 0; i < data.dvb.length; i++) {
                            $('#tbl_ddt tr').has('td div button[data-id="'+data.dvb[i]+'"]').next('tr.spacer').remove();
                            $('#tbl_ddt tr').has('td div button[data-id="'+data.dvb[i]+'"]').remove();
                        }
                    }
                    else{
                        for (var i = 0; i < data.dvb.length; i++) {
                            $('#tbl_dd tr').has('td div button[data-id="'+data.dvb[i]+'"]').next('tr.spacer').remove();
                            $('#tbl_dd tr').has('td div button[data-id="'+data.dvb[i]+'"]').remove();
                        }

                        for (var i = 0; i < data.dvb.length; i++) {
                            $('#tbl_cd tr').has('td div button[data-id="'+data.dvb[i]+'"]').next('tr.spacer').remove();
                            $('#tbl_cd tr').has('td div button[data-id="'+data.dvb[i]+'"]').remove();
                        }
                    }
                    if(data.pl == 'cd'){
                        if($('#id_nv').val() == data.idnvd){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)-data.dvb.length;
                                if(slm == 0){
                                    $('span[class*="spantk"]').remove();
                                    $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa có báo cáo nào!');
                                }
                                else{
                                    $('span[class*="spantk"]').text(slm);
                                    $('span[class*="spantk"]').attr('data-slbc', slm);
                                    $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                                }
                            }
                        }
                    }
                }
                else{
                    if($('#quyen_bs').val() == 'FK'){
                        $('#tbl_ddt tr').has('td div button[data-id="'+data.dvb+'"]').next('tr.spacer').remove();
                        $('#tbl_ddt tr').has('td div button[data-id="'+data.dvb+'"]').remove();
                    }
                    else{
                        $('#tbl_dd tr').has('td div button[data-id="'+data.dvb+'"]').next('tr.spacer').remove();
                        $('#tbl_dd tr').has('td div button[data-id="'+data.dvb+'"]').remove();

                        $('#tbl_cd tr').has('td div button[data-id="'+data.dvb+'"]').next('tr.spacer').remove();
                        $('#tbl_cd tr').has('td div button[data-id="'+data.dvb+'"]').remove();

                    }
                    if(data.pl == 'cd'){
                        if($('#id_nv').val() == data.idnvd){
                            if($('a[class*="bctk"]').find('span[class*="spantk"]').length > 0){
                                var slht=$('span[class*="spantk"]').attr('data-slbc');
                                var slm=parseInt(slht)-1;
                                if(slm == 0){
                                    $('span[class*="spantk"]').remove();
                                    $('a[class*="bctk"]').attr('data-original-title', 'Hiện chưa có báo cáo nào!');
                                }
                                else{
                                    $('span[class*="spantk"]').text(slm);
                                    $('span[class*="spantk"]').attr('data-slbc', slm);
                                    $('a[class*="bctk"]').attr('data-original-title', 'Có '+slm+' báo cáo chờ duyệt!');
                                }
                            }
                        }
                    }
                }

                if(data.pl == 'cd'){
                    for (var i = 0; i < data.dshuy.length; i++) {
                        if(data.dshuy[i]['idnv'] == $('#id_nv').val()){
                            if(data.dshuy[i]['pl'] == 'thong_ke'){
                                if($('#tb_bc').hasClass('hidden')){
                                    $('#tb_bc').removeClass('hidden');

                                    var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                            <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt thống kê ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">×</span></button>\n\
                                            </button>\n\
                                        </div>\n\
                                    </div>';

                                    $('#thong_bao').append(tb);
                                }
                                else{
                                    var tb='<div class="rs-select2--light _'+data.dshuy[i]['id']+'">\n\
                                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">\n\
                                            <span class="badge badge-pill badge-danger">Thông báo!</span> Yêu cầu duyệt thống kê ['+data.dshuy[i]['cd']+'] đã bị hủy bởi '+data.dshuy[i]['nd']+'<button type="button" data-ma="'+data.dshuy[i]['id']+'" class="close closetb" data-dismiss="alert" aria-label="Close">\n\
                                                <span aria-hidden="true">×</span></button>\n\
                                            </button>\n\
                                        </div>\n\
                                    </div>';
                                                    
                                    $('#thong_bao').append(tb);
                                }
                            }
                        }
                    }
                }
                
            }
        }

        channel.bind('App\\Events\\HanhChinh\\DVB', laytt);
        //end xử lý channel
        
        //xóa
        $('#tbl_cd').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa văn bản ["+name+"]?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/duyet_van_ban/xoa',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        // Success
                        if(data.msg == 'tc'){
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" văn bản được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    if(soluongtk > 0){
                                        soluongtk--;    
                                    }
                                    
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" văn bản được tìm thấy!");
                                    }
                                }
                            }
                            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                if($('#tbl_dd').children().length == 0){
                                    $('input[data-input="checksumDD"]').prop("checked",false);
                                }
                            }
                            else{
                                if($('#tbl_cd').children().length == 0){
                                    $('input[data-input="checksumCD"]').prop("checked",false);
                                }
                            }
                            alert("Xóa thông tin văn bản thành công!");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin văn bản thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin văn bản thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //xóa
        $('#tbl_dd').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa văn bản ["+name+"]?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/duyet_van_ban/xoa',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        // Success
                        if(data.msg == 'tc'){
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" văn bản được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    if(soluongtk > 0){
                                        soluongtk--;    
                                    }
                                    
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" văn bản được tìm thấy!");
                                    }
                                }
                            }
                            if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                if($('#tbl_dd').children().length == 0){
                                    $('input[data-input="checksumDD"]').prop("checked",false);
                                }
                            }
                            else{
                                if($('#tbl_cd').children().length == 0){
                                    $('input[data-input="checksumCD"]').prop("checked",false);
                                }
                            }
                            alert("Xóa thông tin văn bản thành công!");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin văn bản thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin văn bản thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //xóa
        $('#tbl_ddt').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa văn bản ["+name+"]?");
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/duyet_van_ban/xoa',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        // Success
                        if(data.msg == 'tc'){
                            if(locds == true){
                                soluongl--;
                                if(soluongl == 0){
                                     $('#kqtimliem').text("");
                                }
                                else{
                                    $('#kqtimliem').text("Có "+soluongl+" văn bản được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    if(soluongtk > 0){
                                        soluongtk--;    
                                    }
                                    
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" văn bản được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_ddt').children().length == 0){
                                $('input[data-input="checksumDD"]').prop("checked",false);
                            }
                            alert("Xóa thông tin văn bản thành công!");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin văn bản thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin văn bản thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin văn bản thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        function loadFile(file) {
            $.ajax({
                url: 'http://localhost/qlkcb/public/upload/baocao/'+file,
                type: 'GET',
                error: function()
                {
                    //not exists
                    $('#framepdf').addClass('hidden');
                    $('#framenone').removeClass('hidden');
                },
                success: function()
                {
                    // exists
                    $('#framepdf').removeClass('hidden');
                    $('#framenone').addClass('hidden');
                    $('#framepdf').attr('src', 'public/upload/baocao/'+file);
                }
            });
        }

        var fileht=0;

        $('#btnfiletruoc').click(function(){
            var files=$(this).attr('data-files');
            if(files.toString().trim() == ''){
                alert('Không có file để xem!');
                return false;
            }
            var arr_f=files.toString().split('|');
            fileht--;
            if(fileht < 0){
                fileht=arr_f.length - 1;
            }
            loadFile(arr_f[fileht]);
        });

        $('#btnfilesau').click(function(){
            var files=$(this).attr('data-files');
            if(files.toString().trim() == ''){
                alert('Không có file để xem!');
                return false;
            }
            var arr_f=files.toString().split('|');
            fileht++;
            if(fileht > arr_f.length - 1){
                fileht=0;
            }
            loadFile(arr_f[fileht]);
        });

        $('#btnduyet').click(function(){
            $('#dtbiarea').removeClass('hidden');$('#dtbi').text('Đang xử lý!');
            $('#proccess').removeClass('hidden');
             var formData = new FormData();
             formData.append('_token', CSRF_TOKEN);
             formData.append('id', $(this).attr('data-id'));
             $.ajax({
                 type: 'POST',
                 dataType: "JSON",
                 url: '/qlkcb/hanh_chinh/duyet_van_ban/duyet',
                 xhr: function() {
                     var myXhr = $.ajaxSettings.xhr();
                     return myXhr;
                 },
                 cache: false,
                 contentType: false,
                 processData: false,
                 data: formData,
                 success: function(data) {
                     // Success
                     if(data.msg =='tc'){
                        $('#dtbi').text('Đã duyệt xong!');
                        $('#proccess').addClass('hidden');
                     }
                     else if(data.msg =='ktt'){
                        alert("Văn bản không tồn tại có thể đã bị xóa!");
                        $('#proccess').addClass('hidden');
                        $('#dtbiarea').addClass('hidden');
                     }
                     else{
                        alert("Duyệt báo cáo thất bại. Lỗi: "+data.msg);
                        $('#proccess').addClass('hidden');
                        $('#dtbiarea').addClass('hidden');
                     }
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Duyệt báo cáo thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Duyệt báo cáo thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Duyệt báo cáo thất bạii! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                    $('#proccess').addClass('hidden');
                    $('#dtbiarea').addClass('hidden');
                 }
             });
        });

        $('#tbl_cd').on('click','button[data-button="duyet"]',function(){
            $('#proccess').addClass('hidden');
            $('#dtbiarea').addClass('hidden');
            $('#btnfiletruoc').attr('data-files', $(this).attr('data-src'));
            $('#btnfilesau').attr('data-files', $(this).attr('data-src'));
            $('#btnduyet').attr('data-id', $(this).attr('data-id'));
            $('#btnduyet').removeClass('hidden');
            var files=$(this).attr('data-src');
            if(files.toString().trim() == ''){
                alert('Không có file để xem!');
                return false;
            }
            var arr_f=files.toString().split('|');
            loadFile(arr_f[0]);
        });
        //end mở form để sửa

        $('#tbl_dd').on('click','button[data-button="xemfile"]',function(){
            $('#proccess').addClass('hidden');
            $('#dtbiarea').addClass('hidden');
            $('#btnfiletruoc').attr('data-files', $(this).attr('data-src'));
            $('#btnfilesau').attr('data-files', $(this).attr('data-src'));
            $('#btnduyet').attr('data-id', $(this).attr('data-id'));
            $('#btnduyet').addClass('hidden');
            var files=$(this).attr('data-src');
            if(files.toString().trim() == ''){
                alert('Không có file để xem!');
                return false;
            }
            var arr_f=files.toString().split('|');
            loadFile(arr_f[0]);
        });
        
        $('#tbl_ddt').on('click','button[data-button="xemfile"]',function(){
            $('#btnfiletruoc').attr('data-files', $(this).attr('data-src'));
            $('#btnfilesau').attr('data-files', $(this).attr('data-src'));
            var files=$(this).attr('data-src');
            if(files.toString().trim() == ''){
                alert('Không có file để xem!');
                return false;
            }
            var arr_f=files.toString().split('|');
            loadFile(arr_f[0]);
        });
        
        $('#custom-nav-profile-tab').click(function(){
            $('#kqtimliem').text("");soluongtk=0;
        });
        $('#custom-nav-home-tab').click(function(){
            $('#kqtimliem').text("");soluongtk=0;
        });

        //tìm kiếm
        $('#btntimkiem').click(function (){
            if($('#quyen_bs').val() == 'FK'){
                $('input[data-input="checksumDD"]').prop("checked",false);
                $('input[data-input="check"]').prop("checked",false);
            }
            else{
                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    $('input[data-input="checksumDD"]').prop("checked",false);
                    $('#tbl_dd input[data-input="check"]').prop("checked",false);
                }
                else{
                    $('input[data-input="checksumCD"]').prop("checked",false);
                    $('#tbl_cd input[data-input="check"]').prop("checked",false);
                }
            }
            if($('#txttimkiem').val().toString().trim() == ''){
                alert('Vui lòng nhập thông tin tìm kiếm!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('keyWords', $('#txttimkiem').val());
            formData.append('idnv', $('#id_nv').val());
            
            if($('#quyen_bs').val() == 'FK'){
                formData.append('loaiform', 'hct');
            }
            else{
                formData.append('loaiform', 'hc');
                if($('#quyen_bs').val() == 'FALSE'){
                    formData.append('loaibc', 'sp');
                }
                else{
                    formData.append('loaibc', 'hh');
                }


                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    formData.append('ttd', 'dd');

                }
                else{
                    formData.append('ttd', 'cd');
                }
            }
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/duyet_van_ban/tim_kiem',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg != 'tc'){
                        alert("Tìm kiếm gặp phải lỗi! Mô tả: "+data.msg);
                    }else{
                        if(data.sl > 0){
                            soluongtk=data.sl;
                            var ttbc='';
                            if(data.loaif == false){
                                if(data.loaibc == true){
                                    for(var i=0; i<data.bc.length; ++i){
                                        ttbc+='\n\
                                        <tr class="tr-shadow">\n\
                                            <td style="vertical-align: middle;">\n\
                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                    <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                    <span class="au-checkmark"></span>\n\
                                                </label>\n\
                                            </td>\n\
                                            <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                            <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                            <td>'+data.bc[i].ngaygui+'</td>\n\
                                            <td class="text-right">'+data.bc[i].sofile+'</td>\n\
                                            <td>\n\
                                                <div class="table-data-feature">\n\
                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Duyệt" data-button="duyet" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                        <i class="fa fa-check"  ></i>\n\
                                                    </button>\n\
                                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                        <i class="zmdi zmdi-delete"></i>\n\
                                                    </button>\n\
                                                </div>\n\
                                            </td>\n\
                                        </tr>\n\
                                        <tr class="spacer"></tr>';
                                    }
                                    $('#tbl_cd').html(ttbc);
                                    $('#tbl_cd button[data-button]').tooltip({
                                        trigger: 'manual'
                                    })
                                    .focus(hideTooltip)
                                    .blur(hideTooltip)
                                    .hover(showTooltip, hideTooltip);
                                }
                                else{
                                    for(var i=0; i<data.bc.length; ++i){
                                        ttbc+='\n\
                                        <tr class="tr-shadow">\n\
                                            <td style="vertical-align: middle;">\n\
                                                <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                    <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                    <span class="au-checkmark"></span>\n\
                                                </label>\n\
                                            </td>\n\
                                            <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                            <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                            <td>'+data.bc[i].ngaygui+'</td>\n\
                                            <td>'+data.bc[i].sofile+'</td>\n\
                                            <td>'+data.bc[i].ngayduyet+'</td>\n\
                                            <td class="text-left">'+data.bc[i].nguoiduyet+'</td>\n\
                                            <td>\n\
                                                <div class="table-data-feature">\n\
                                                    <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                        <i class="fa fa-eye"  ></i>\n\
                                                    </button>\n\
                                                    <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                        <i class="zmdi zmdi-delete"></i>\n\
                                                    </button>\n\
                                                </div>\n\
                                            </td>\n\
                                        </tr>\n\
                                        <tr class="spacer"></tr>';
                                    }
                                    $('#tbl_dd').html(ttbc);
                                    $('#tbl_dd button[data-button]').tooltip({
                                        trigger: 'manual'
                                    })
                                    .focus(hideTooltip)
                                    .blur(hideTooltip)
                                    .hover(showTooltip, hideTooltip);
                                }
                            }
                            else{
                                for(var i=0; i<data.bc.length; ++i){
                                    ttbc+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                        <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                        <td>'+data.bc[i].ngaygui+'</td>\n\
                                        <td>'+data.bc[i].sofile+'</td>\n\
                                        <td>'+data.bc[i].ngayduyet+'</td>\n\
                                        <td class="text-left">'+data.bc[i].nguoiduyet+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                    <i class="fa fa-eye"  ></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                $('#tbl_ddt').html(ttbc);
                                $('#tbl_ddt button[data-button]').tooltip({
                                    trigger: 'manual'
                                })
                                .focus(hideTooltip)
                                .blur(hideTooltip)
                                .hover(showTooltip, hideTooltip);
                            }
                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" văn bản được tìm thấy!");
                        }
                        else{
                            if(data.loaif == false){
                                if(data.loaibc == true){
                                    $('#tbl_cd').html('');
                                }
                                else{
                                    $('#tbl_dd').html('');
                                }
                            }
                            else{
                                $('#tbl_ddt').html('');
                            }
                            $('#kqtimliem').text("Không có văn bản nào được tìm thấy!");tk=false;
                        }
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tìm kiếm thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tìm kiếm thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tìm kiếm thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end tìm kiếm

        //Nạp lại danh sách
        $('#btnnapds').click(function(){
            if($('#quyen_bs').val() == 'FK'){
                $('input[data-input="checksumDD"]').prop("checked",false);
                $('input[data-input="check"]').prop("checked",false);
            }
            else{
                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    $('input[data-input="checksumDD"]').prop("checked",false);
                    $('#tbl_dd input[data-input="check"]').prop("checked",false);
                }
                else{
                    $('input[data-input="checksumCD"]').prop("checked",false);
                    $('#tbl_cd input[data-input="check"]').prop("checked",false);
                }
            }
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            
            if($('#quyen_bs').val() == 'FK'){
                formData.append('loaiform', 'hct');
            }
            else{
                formData.append('loaiform', 'hc');
                if($('#quyen_bs').val() == 'FALSE'){
                    formData.append('loaibc', 'sp');
                }
                else{
                    formData.append('loaibc', 'hh');
                }


                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    formData.append('ttd', 'dd');

                }
                else{
                    formData.append('ttd', 'cd');
                }
            }
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/duyet_van_ban/lay_ds',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    // Success
                    if(data.msg != 'tc'){
                        alert("Lỗi khi tải danh sách văn bản! Mô tả: "+data.msg);
                    }else{
                        var ttbc='';
                        if(data.loaif == false){
                            if(data.loaibc == true){
                                for(var i=0; i<data.bc.length; ++i){
                                    ttbc+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                        <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                        <td>'+data.bc[i].ngaygui+'</td>\n\
                                        <td class="text-right">'+data.bc[i].sofile+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Duyệt" data-button="duyet" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                    <i class="fa fa-check"  ></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                $('#tbl_cd').html(ttbc);
                                $('#tbl_cd button[data-button]').tooltip({
                                    trigger: 'manual'
                                })
                                .focus(hideTooltip)
                                .blur(hideTooltip)
                                .hover(showTooltip, hideTooltip);
                            }
                            else{
                                for(var i=0; i<data.bc.length; ++i){
                                    ttbc+='\n\
                                    <tr class="tr-shadow">\n\
                                        <td style="vertical-align: middle;">\n\
                                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                                <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                <span class="au-checkmark"></span>\n\
                                            </label>\n\
                                        </td>\n\
                                        <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                        <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                        <td>'+data.bc[i].ngaygui+'</td>\n\
                                        <td>'+data.bc[i].sofile+'</td>\n\
                                        <td>'+data.bc[i].ngayduyet+'</td>\n\
                                        <td class="text-left">'+data.bc[i].nguoiduyet+'</td>\n\
                                        <td>\n\
                                            <div class="table-data-feature">\n\
                                                <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                    <i class="fa fa-eye"  ></i>\n\
                                                </button>\n\
                                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                    <i class="zmdi zmdi-delete"></i>\n\
                                                </button>\n\
                                            </div>\n\
                                        </td>\n\
                                    </tr>\n\
                                    <tr class="spacer"></tr>';
                                }
                                $('#tbl_dd').html(ttbc);
                                $('#tbl_dd button[data-button]').tooltip({
                                    trigger: 'manual'
                                })
                                .focus(hideTooltip)
                                .blur(hideTooltip)
                                .hover(showTooltip, hideTooltip);
                            }
                        }
                        else{
                            for(var i=0; i<data.bc.length; ++i){
                                ttbc+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td class="text-left">'+data.bc[i].cd+'</td>\n\
                                    <td class="text-left">'+data.bc[i].nguoigui+'</td>\n\
                                    <td>'+data.bc[i].ngaygui+'</td>\n\
                                    <td>'+data.bc[i].sofile+'</td>\n\
                                    <td>'+data.bc[i].ngayduyet+'</td>\n\
                                    <td class="text-left">'+data.bc[i].nguoiduyet+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button type="button" class="item" data-toggle="modal" data-target="#modaldvb" rel="tooltip" data-placement="top" title="Xem file" data-button="xemfile" data-id="'+data.bc[i].id+'" data-src="'+data.bc[i].src+'">\n\
                                                <i class="fa fa-eye"  ></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.bc[i].id+'" data-name="'+data.bc[i].cd+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_ddt').html(ttbc);
                            $('#tbl_ddt button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);
                        }

                        tk=false;locds=false;keySearch='';
                        $('#kqtimliem').text("");
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Tải danh sách thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Tải danh sách thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Tải danh sách thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Nạp lại danh sách

        //nhấn enter tìm kiếm
        $("#ftimkiem").keypress(function(e) {
              var key = e.charCode || e.keyCode || 0;
              if (key == 13) {
                e.preventDefault();
                $('#btntimkiem').click();
              }
        });
        //end

         //click check sum
        $('body').on('change', 'input[data-input="checksumDD"]', function(){
            if($('body').find('#tbl_ddt').length > 0){
                if($(this).prop("checked")){
                    $('input[data-input="check"]').prop("checked",true);
                }
                else{
                    $('input[data-input="check"]').prop("checked",false);
                }
            }
            else{
                if($(this).prop("checked")){
                    $('#tbl_dd input[data-input="check"]').prop("checked",true);
                }
                else{
                    $('#tbl_dd input[data-input="check"]').prop("checked",false);
                }
            }
        });
        //end

        //click check
        $('#tbl_dd').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumDD"]').prop("checked",false);
            }
            else{
                if($('#tbl_dd input[data-input="check"]:checked').length == $('#tbl_dd input[data-input="check"]').length){
                    $('input[data-input="checksumDD"]').prop("checked",true);
                }
            }
        });
        //end

        //click check sum
        $('body').on('change', 'input[data-input="checksumCD"]', function(){
            if($(this).prop("checked")){
                $('#tbl_cd input[data-input="check"]').prop("checked",true);
            }
            else{
                $('#tbl_cd input[data-input="check"]').prop("checked",false);
            }
        });
        //end

        //click check
        $('#tbl_cd').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumCD"]').prop("checked",false);
            }
            else{
                if($('#tbl_cd input[data-input="check"]:checked').length == $('#tbl_cd input[data-input="check"]').length){
                    $('input[data-input="checksumCD"]').prop("checked",true);
                }
            }
        });
        //end

        //click check
        $('#tbl_ddt').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksumDD"]').prop("checked",false);
            }
            else{
                if($('input[data-input="check"]:checked').length == $('input[data-input="check"]').length){
                    $('input[data-input="checksumDD"]').prop("checked",true);
                }
            }
        });
        //end
        
        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if($('#quyen_bs').val() == 'FK'){
                if(!$('input[data-input="check"]').is(":checked")){
                    alert("Bạn chưa chọn văn bản để xóa!");
                    return false;
                }
            }
            else{
                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    if(!$('#tbl_dd input[data-input="check"]').is(":checked")){
                        alert("Bạn chưa chọn văn bản để xóa!");
                        return false;
                    }
                }
                else{
                    if(!$('#tbl_cd input[data-input="check"]').is(":checked")){
                        alert("Bạn chưa chọn văn bản để xóa!");
                        return false;
                    }
                }
            }
            
            var name='';var arr=[],arr_name=[];
            if($('#quyen_bs').val() == 'FK'){
                $('input[data-input="check"]').each(function(){
                    if($(this).is(":checked")){
                        $.each(this.attributes, function() {
                            if (this.name.indexOf('data-id') == 0) {
                                arr.push(this.value);
                            }
                            if (this.name.indexOf('data-name') == 0) {
                                arr_name.push(this.value);
                            }
                        });
                    }
                });
            }
            else{
                if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                    $('#tbl_dd input[data-input="check"]').each(function(){
                        if($(this).is(":checked")){
                            $.each(this.attributes, function() {
                                if (this.name.indexOf('data-id') == 0) {
                                    arr.push(this.value);
                                }
                                if (this.name.indexOf('data-name') == 0) {
                                    arr_name.push(this.value);
                                }
                            });
                        }
                    });
                }
                else{
                    $('#tbl_cd input[data-input="check"]').each(function(){
                        if($(this).is(":checked")){
                            $.each(this.attributes, function() {
                                if (this.name.indexOf('data-id') == 0) {
                                    arr.push(this.value);
                                }
                                if (this.name.indexOf('data-name') == 0) {
                                    arr_name.push(this.value);
                                }
                            });
                        }
                    });
                }
            }

            if(arr_name.length > 1){
                for (var i = 0; i < arr_name.length; i++) {
                    name+=arr_name[i];
                    if(i == arr_name.length - 2){
                        name+=' và ';
                    }
                    else if(i < arr_name.length - 2)
                    {
                        name+=', ';
                    }
                }
            }
            else
            {
                name=arr_name[0];
            }
            var cf;
            if(arr_name.length > 1){
                cf=confirm("Bạn có thực sự muốn xóa các văn bản có chủ đề "+name+"?");
            }
            else
            {
                cf=confirm("Bạn có thực sự muốn xóa văn bản có chủ đề "+name+"?");
            }
            if(cf==true){
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', arr);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/duyet_van_ban/xoa',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        return myXhr;
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(data) {
                        // Success
                        if(data.msg == 'tc'){
                            if(arr.length > 1){
                                if(locds == true){
                                    soluongl = soluongl - arr.length;
                                    if(soluongl == 0)
                                    {
                                        $('#kqtimliem').text("");
                                    }
                                    else
                                    {
                                        $('#kqtimliem').text("Có "+soluongl+" văn bản được tìm thấy!");
                                    }
                                }
                                else{
                                    if(tk == true){
                                        if(soluongtk > 0){
                                            soluongtk = soluongtk - arr.length;   
                                        }
                                        
                                        if(soluongtk == 0)
                                        {
                                            $('#kqtimliem').text("");
                                        }
                                        else
                                        {
                                            $('#kqtimliem').text("Có "+soluongtk+" văn bản được tìm thấy!");
                                        }
                                    }
                                }
                                if($('#quyen_bs').val() == 'FK'){
                                    if($('#tbl_ddt').children().length == 0){
                                        $('input[data-input="checksumDD"]').prop("checked",false);
                                    }
                                }
                                else{
                                    if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                        if($('#tbl_dd').children().length == 0){
                                            $('input[data-input="checksumDD"]').prop("checked",false);
                                        }
                                    }
                                    else{
                                        if($('#tbl_cd').children().length == 0){
                                            $('input[data-input="checksumCD"]').prop("checked",false);
                                        }
                                    }
                                }
                                alert("Xóa thông tin các văn bản thành công!");
                            }
                            else
                            {
                                if(locds == true){
                                    $('#kqtimliem').text("Có "+(soluongl - 1)+" văn bản được tìm thấy!");
                                }
                                else{
                                    if(tk == true){
                                        $('#kqtimliem').text("Có "+(soluongtk - 1)+" văn bản được tìm thấy!");
                                    }
                                }
                                if($('#quyen_bs').val() == 'FK'){
                                    if($('#tbl_ddt').children().length == 0){
                                        $('input[data-input="checksumDD"]').prop("checked",false);
                                    }
                                }
                                else{
                                    if($('#custom-nav-profile-tab').attr('aria-selected') == 'true'){
                                        if($('#tbl_dd').children().length == 0){
                                            $('input[data-input="checksumDD"]').prop("checked",false);
                                        }
                                    }
                                    else{
                                        if($('#tbl_cd').children().length == 0){
                                            $('input[data-input="checksumCD"]').prop("checked",false);
                                        }
                                    }
                                }
                                alert("Xóa thông tin văn bản thành công!");
                            }
                        }
                        else{
                            if(arr.length > 1)
                            {
                                alert("Xóa thông tin các văn bản thất bại! Lỗi: "+data.msg);
                            }
                            else
                            {
                                alert("Xóa thông tin văn bản thất bại! Lỗi: "+data.msg);
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(arr.length > 1)
                        {
                            if(jqXHR.status == 419){
                                alert("Xóa thông tin các văn bản thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Xóa thông tin các văn bản thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Xóa thông tin các văn bản thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                        }
                        else
                        {
                            if(jqXHR.status == 419){
                                alert("Xóa thông tin văn bản thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                            }
                            else if(jqXHR.status == 500){
                                alert("Xóa thông tin văn bản thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                            }
                            else{
                                alert("Xóa thông tin văn bản thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                            }
                        }
                    }
                });
            }
        });
        //end
    });
    </script>
@endsection