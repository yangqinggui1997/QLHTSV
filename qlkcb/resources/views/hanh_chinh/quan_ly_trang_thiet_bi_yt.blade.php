@extends('hanh_chinh.layout')

@section('title')
    {{ "Thông tin trang thiết bị y tế" }}
@endsection

@section('css')
<link href="public/css/tempusdominus-bootstrap-4.css" rel="stylesheet" media="all">
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
        @if($flag==FALSE)
        <input type="hidden" id="quyen_bs" value="FALSE">
        @endif
                <!-- THÊM MỚI THÔNG TIN TTB-->
                <section class="p-t-20 hidden" id="formttb" >
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green" id="formtitle">THÊM THÔNG TIN TRANG THIẾT BỊ Y TẾ MỚI</h3>
                                    <hr class="line-seprate">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body card-block">
                                                <form>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tên thiết bị y tế (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập tên thiết bị y tế..." class="form-control" id="tentb"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nhà sản xuất (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập nhà sản xuất..." class="form-control" id="nsx"/> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Nhà cung ứng (<span class="color-red">*</span>)</label>
                                                                <input type="text" placeholder="Nhập nhà cung ứng..." class="form-control" id="ncu"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Ngày nhập</label>
                                                                <div class="input-group date" id="dtpngaynhap" data-target-input="nearest">
                                                                    <input type="text" onkeydown="return false" id="ngaynhap" class="form-control datetimepicker-input" data-target="#dtpngaynhap" />
                                                                    <div class="input-group-append" data-target="#dtpngaynhap" data-toggle="datetimepicker">
                                                                        <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Đơn giá nhập (<span class="color-red">*</span>)</label>
                                                                <input type="number" min="1" placeholder="VD: 2500000" class="form-control" id="dgn"/>  
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Chức năng (<span class="color-red">*</span>)</label>
                                                                <textarea rows="1" placeholder="Nhập chức năng của thiết bị..." class="form-control" id="cn"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phân loại</label>
                                                                <select class="form-control" id="pl">
                                                                    <option value="giuong_benh">Giường bệnh</option>
                                                                    <option value="bo_thu_chan_doan_benh_sot_ret">Bộ thử chẩn đoán bệnh sốt rét</option>
                                                                    <option value="cac_san_pham_da_hoac_chua_pha_tron_dung_cho_phong_benh_hoac_chua_benh">Các sản phẩm đã hoặc chưa pha trộn dùng cho phòng bệnh hoặc chữa bệnh (ví dụ: dung dịch xịt hoặc kem phòng ngừa loét do tì đè; dung dịch muối biển vệ sinh mũi; xịt mũi nước biển; xịt tai, xịt họng; nước mắt nhân tạo; nhũ tương nhỏ mắt; gel hoặc dung dịch làm ẩm, làm mềm vết thương, gel dùng cho vết thương ở miệng; dịch lọc thận...)</option>
                                                                    <option value="bang_dan_va_cac_san_pham_co_mot_lop_dinh_da_trang_phu_hoac_tham_tam_duoc_chat">Băng dán và các sản phẩm có một lớp dính đã tráng phủ hoặc thấm tẩm dược chất</option>
                                                                    <option value="bang_dan_va_cac_san_pham_co_mot_lop_dinh_khong_trang_phu_hoac_khong_tham_tam_duoc_chat">Băng dán và các sản phẩm có một lớp dính không tráng phủ hoặc không thấm tẩm dược chất (ví dụ: miếng dán sát khuẩn; miếng dán hạ sốt; miếng dán lạnh; miếng dán giữ nhiệt...)</option>
                                                                    <option value="bang_y_te">Băng y tế</option>
                                                                    <option value="gac_y_te">Gạc y tế</option>
                                                                    <option value="bong_y_te">Bông y tế</option>
                                                                    <option value="chi_tu_tieu_vo_trung_dung_cho_nha_khoa_hoac_phau_thuat_mieng_chan_dinh_mieng_dem_vo_trung_dung_trong_nha_khoa_hoac_phau_thuat_co_hoac_khong_tu_tieu">Chỉ tự tiêu vô trùng dùng cho nha khoa hoặc phẫu thuật; miếng chắn dính, miếng đệm vô trùng dùng trong nha khoa hoặc phẫu thuật, có hoặc không tự tiêu</option>
                                                                    <option value="chi_khong_tu_tieu_san_pham_cam_mau_tu_tieu_vo_trung_trong_phau_thuat_hoac_nha_khoa_vat_lieu_cam_mau_tam_nang_phau_thuat_luoi_dieu_tri_thoat_vi_keo_dan_sinh_hoc_mang_ngan_hap_thu_sinh_hoc_keo_tao_mang_vo_trung_dung_de_khep_mieng_vet_thuong_trong_phau_thuat_tao_nong_vo_trung_va_nut_tao_nong_vo_trung">Chỉ không tự tiêu, sản phẩm cầm máu tự tiêu vô trùng trong phẫu thuật hoặc nha khoa; vật liệu cầm máu; tấm nâng phẫu thuật; lưới Điều trị thoát vị; keo dán sinh học; màng ngăn hấp thu sinh học; keo tạo màng vô trùng dùng để khép miệng vết thương trong phẫu thuật; tảo nong vô trùng và nút tảo nong vô trùng</option>
                                                                    <option value="chat_thu_nhom_mau">Chất thử nhóm máu</option>
                                                                    <option value="xi_mang_han_rang_va_cac_chat_han_rang_khac">Xi măng hàn răng và các chất hàn răng khác</option>
                                                                    <option value="hop_bo_dung_cu_cap_cuu_bo_kit_cham_soc_vet_thuong">Hộp, bộ dụng cụ cấp cứu; bộ kít chăm sóc vết thương</option>
                                                                    <option value="cac_che_pham_gel_duoc_san_xuat_de_dung_cho_nguoi_nhu_chat_boi_tron_cho_cac_bo_phan_cua_co_the_khi_tien_hanh_phau_thuat_hoac_kham_benh_hoac_nhu_mot_chat_gan_ket_giua_co_the_va_thiet_bi_y_te_vi_du_gel_sieu_am_gel_boi_tron_am_dao_dich_nhay_dung_trong_phau_thuat_phaco_">Các chế phẩm gel được sản xuất để dùng cho người như chất bôi trơn cho các bộ phận của cơ thể khi tiến hành phẫu thuật hoặc khám bệnh hoặc như một chất gắn kết giữa cơ thể và thiết bị y tế (ví dụ: gel siêu âm, gel bôi trơn âm đạo; dịch nhầy dùng trong phẫu thuật Phaco...)</option>
                                                                    <option value="dung_cu_chuyen_dung_cho_mo_tao_hau_mon_gia">Dụng cụ chuyên dụng cho mổ tạo hậu môn giả</option>
                                                                    <option value="bot_va_bot_nhao_lam_chat_chan_rang">Bột và bột nhão làm chặt chân răng</option>
                                                                    <option value="dung_dich_ngam_rua_lam_sach_bao_quan_kinh_ap_trong">Dung dịch ngâm, rửa, làm sạch, bảo quản kính áp tròng</option>
                                                                    <option value="phim_x_quang_dung_trong_y_te">Phim X quang dùng trong y tế</option>
                                                                    <option value="tam_cam_bien_nhan_anh_x_quang_y_te">Tấm cảm biến nhận ảnh X quang y tế</option>
                                                                    <option value="dung_dich_hoa_chat_khu_khuan_dung_cu_thiet_bi_y_te">Dung dịch, hóa chất khử khuẩn dụng cụ, thiết bị y tế</option>
                                                                    <option value="tam_phien_mang_la_va_dai_bang_plastic_duoc_tham_tam_hoac_trang_phu_chat_thu_chan_doan_benh">Tấm, phiến, màng, lá và dải bằng plastic được thấm, tẩm hoặc tráng phủ chất thử chẩn đoán bệnh</option>
                                                                    <option value="bia_tam_xo_soi_xenlulo_va_mang_xo_soi_xenlulo_duoc_tham_tam_hoac_trang_phu_chat_thu_chan_doan_benh">Bìa, tấm xơ sợi xenlulo và màng xơ sợi xenlulo được thấm, tẩm hoặc tráng phủ chất thử chẩn đoán bệnh</option>
                                                                    <option value="chat_thu_chuan_doan_benh_khac">Chất thử chẩn đoán bệnh khác (ví dụ: que thử, khay thử; chất thử, chất hiệu chuẩn, vật liệu kiểm soát in vitro...)</option>
                                                                    <option value="chat_thu_chan_doan_benh_khac_vi_du_que_thu_khay_thu_chat_thu_chat_hieu_chuan_vat_lieu_kiem_soat_in_vitro">Chất thử chẩn đoán bệnh khác (ví dụ: que thử, khay thử; chất thử, chất hiệu chuẩn, vật liệu kiểm soát in vitro...)</option>
                                                                    <option value="cac_san_pham_khac_bang_plastic_vi_du_cuvet_dau_con_khay_ngam_dung_cu_tiet_khuan_bo_chuyen_tiep_ong_noi_mieng_nep_sau_phau_thuat_mat_na_co_dinh_kep_ong_thong_day_dan_mieng_dan_giu_ong_thong_tui_dung_nuoc_tieu_tui_dung_dich_xa_trong_loc_mang_bung_ong_nghiem_chua_chat_chong_dong_tui_ep_tiet_trung_bao_bi_dung_dung_cu_khong_chua_giay_bao_chup_dau_den_bao_camera_noi_soi_tui_dung_benh_pham_noi_soi_">Các sản phẩm khác bằng plastic (ví dụ: cuvet, đầu côn, khay ngâm dụng cụ tiệt khuẩn; bộ chuyển tiếp, ống nối; miếng nẹp sau phẫu thuật; mặt nạ cố định; kẹp ống thông, dây dẫn; miếng dán giữ ống thông; túi đựng nước tiểu; túi đựng dịch xả trong lọc màng bụng; ống nghiệm chứa chất chống đông; túi ép tiệt trùng, bao bì đựng dụng cụ không chứa giấy; bao chụp đầu đèn; bao camera nội soi; túi đựng bệnh phẩm nội soi...)</option>
                                                                    <option value="gang_tay_phau_thuat">Găng tay phẫu thuật</option>
                                                                    <option value="gang_kham">Găng khám</option>
                                                                    <option value="mat_hang_bao_bi_dung_trong_xu_ly_tiet_trung_dung_cu_y_te_dang_tui_lam_tu_nhua_va_giay_giay_chiem_ham_luong_nhieu_hon_gom_hai_mat_mot_mat_bang_plastic_mot_mat_bang_giay_duoc_dan_kin_3_canh_canh_con_lai_co_mot_dai_bang_keo_de_co_the_dan_tui_tui_dang_da_dong_goi_ban_le">Mặt hàng bao bì dùng trong xử lý tiệt trùng dụng cụ y tế, dạng túi làm từ nhựa và giấy (giấy chiếm hàm lượng nhiều hơn), gồm hai mặt (một mặt bằng plastic, một mặt bằng giấy), được dán kín 3 cạnh, cạnh còn lại có một dải băng keo để có thể dán túi. Túi dạng đã đóng gói bán lẻ.</option>
                                                                    <option value="mat_hang_san_pham_dung_trong_xu_ly_tiet_trung_dung_cu_y_te_dang_ong_duoc_ep_det_gom_2_mat_mot_mat_bang_giay_mot_mat_bang_polyester_giay_chiem_ham_luong_nhieu_hon_da_duoc_dan_kin_2_canh_voi_nhau_dong_thanh_dang_cuon">Mặt hàng sản phẩm dùng trong xử lý tiệt trùng dụng cụ y tế, dạng ống được ép dẹt, gồm 2 mặt (một mặt bằng giấy, một mặt bằng polyester, giấy chiếm hàm lượng nhiều hơn) đã được dán kín 2 cạnh với nhau, đóng thành dạng cuộn</option>
                                                                    <option value="tat_vo_dung_cho_nguoi_gian_tinh_mach_tu_soi_tong_hop">Tất, vớ dùng cho người giãn tĩnh mạch, từ sợi tổng hợp</option>
                                                                    <option value="ao_phau_thuat">Áo phẫu thuật</option>
                                                                    <option value="hang_may_mac_tu_bong_loai_co_tinh_dan_hoi_bo_chat_de_dieu_tri_mo_vet_seo_va_ghep_da">Hàng may mặc từ bông, loại có tính đàn hồi bó chặt để Điều trị mô vết sẹo và ghép da</option>
                                                                    <option value="hang_may_mac_tu_vat_lieu_det_khac_loai_co_tinh_dan_hoi_bo_chat_de_dieu_tri_mo_vet_seo_va_ghep_da">Hàng may mặc từ vật liệu dệt khác, loại có tính đàn hồi bó chặt để Điều trị mô vết sẹo và ghép da</option>
                                                                    <option value="khau_trang_phau_thuat">Khẩu trang phẫu thuật</option>
                                                                    <option value="thiet_bi_khu_trung_dung_trong_y_te_phau_thuat_vi_du_may_hap_tiet_trung_noi_hap_tiet_trung_may_tiet_trung_nhiet_do_thap_cong_nghe_plasma_">Thiết bị khử trùng dùng trong y tế, phẫu thuật (Ví dụ: máy hấp tiệt trùng; nồi hấp tiệt trùng; máy tiệt trùng nhiệt độ thấp công nghệ plasma;...)</option>
                                                                    <option value="may_ly_tam_chuyen_dung_trong_chan_doan_xet_nghiem_sang_loc_y_te">Máy ly tâm chuyên dùng trong chẩn đoán, xét nghiệm, sàng lọc y tế</option>
                                                                    <option value="xe_lan_xe_day_cang_cuu_thuong_va_cac_xe_tuong_tu_duoc_thiet_ke_dac_biet_de_cho_nguoi_tan_tat_co_hoac_khong_co_co_cau_van_hanh_co_gioi">Xe lăn, xe đẩy, cáng cứu thương và các xe tương tự được thiết kế đặc biệt để chở người tàn tật có hoặc không có cơ cấu vận hành cơ giới</option>
                                                                    <option value="kinh_ap_trong_can_vien_loan">Kính áp tròng (cận, viễn, loạn)</option>
                                                                    <option value="kinh_lup_phau_thuat_thiet_bi_soi_da">Kính lúp phẫu thuật, thiết bị soi da</option>
                                                                    <option value="kinh_thuoc">Kính thuốc</option>
                                                                    <option value="kinh_hien_vi_phau_thuat">Kính hiển vi phẫu thuật</option>
                                                                    <option value="may_chieu_tia_laser_co2_dieu_tri">Máy chiếu tia laser CO2 Điều trị</option>
                                                                    <option value="thiet_bi_dien_tim">Thiết bị điện tim</option>
                                                                    <option value="thiet_bi_sieu_am_dung_trong_y_te_vi_du_may_sieu_am_chan_doan_may_do_do_loang_xuong_bang_sieu_am_may_do_nhip_tim_thai_bang_sieu_am_he_thong_thiet_bi_sieu_am_cuong_do_cao_dieu_tri_khoi_u">Thiết bị siêu âm dùng trong y tế (ví dụ: máy siêu âm chẩn đoán; máy đo độ loãng xương bằng siêu âm; máy đo nhịp tim thai bằng siêu âm, hệ thống thiết bị siêu âm cường độ cao Điều trị khối u...)</option>
                                                                    <option value="thiet_bi_chup_cong_huong_tu">Thiết bị chụp cộng hưởng từ</option>
                                                                    <option value="thiet_bi_ghi_bieu_do_nhap_nhay">Thiết bị ghi biểu đồ nhấp nháy</option>
                                                                    <option value="may_theo_doi_benh_nhan_may_do_do_vang_da_may_dien_nao_may_dien_co_he_thong_noi_soi_chan_doan_may_do_phan_tich_chuc_nang_ho_hap_thiet_bi_dinh_vi_trong_phau_thuat_va_thiet_bi_kiem_tra_tham_do_chuc_nang_hoac_kiem_tra_thong_so_sinh_ly_khac">Máy theo dõi bệnh nhân; máy đo độ vàng da; máy điện não; máy điện cơ; hệ thống nội soi chẩn đoán; máy đo/phân tích chức năng hô hấp; thiết bị định vị trong phẫu thuật và thiết bị kiểm tra thăm dò chức năng hoặc kiểm tra thông số sinh lý khác</option>
                                                                    <option value="bom_tiem_dung_mot_lan">Bơm tiêm dùng một lần</option>
                                                                    <option value="bom_tiem_dien_may_truyen_dich">Bơm tiêm điện, máy truyền dịch</option>
                                                                    <option value="kim_tiem_bang_kim_loai_kim_khau_vet_thuong_kim_phau_thuat_bang_kim_loai_kim_but_lay_mau_va_dich_co_the_kim_dung_voi_he_thong_than_nhan_tao_kim_luon_mach_mau">Kim tiêm bằng kim loại, kim khâu vết thương; kim phẫu thuật bằng kim loại; kim, bút lấy máu và dịch cơ thể; kim dùng với hệ thống thận nhân tạo; kim luồn mạch máu</option>
                                                                    <option value="ong_thong_duong_tieu">Ống thông đường tiểu</option>
                                                                    <option value="ong_thong_ong_dan_luu_va_loai_tuong_tu_khac_vi_du_dung_cu_mo_duong_vao_mach_mau_bo_kit_pool_tieu_cau_va_loc_bach_cau_day_noi_qua_loc_mau_rut_nuoc_day_dan_mau_day_thong_da_day_ong_thong_cho_an_dung_cu_lay_mau_mau_day_noi_dai_bom_tiem_dien_ong_dan_luu_ong_thong">Ống thông, ống dẫn lưu và loại tương tự khác (ví dụ: dụng cụ mở đường vào mạch máu; bộ kít pool tiểu cầu và lọc bạch cầu; dây nối quả lọc máu rút nước; dây dẫn máu; dây thông dạ dày; ống thông cho ăn; dụng cụ lấy máu mẫu; dây nối dài bơm tiêm điện; ống dẫn lưu, ống thông...)</option>
                                                                    <option value="khoan_dung_trong_nha_khoa_co_hoac_khong_gan_lien_cung_mot_gia_do_voi_thiet_bi_nha_khoa_khac">Khoan dùng trong nha khoa, có hoặc không gắn liền cùng một giá đỡ với thiết bị nha khoa khác</option>
                                                                    <option value="thiet_bi_va_dung_cu_nhan_khoa_khac_vi_du_may_do_khuc_xa_giac_mac_tu_dong_may_do_dien_vong_mac_may_chup_cat_lop_day_mat_may_chup_huynh_quang_day_mat_he_thong_phau_thuat_chuyen_nganh_nhan_khoa_laser_excimer_phemtosecond_laser_phaco_may_cat_dich_kinh_may_cat_vat_giac_mac_may_laser_dieu_tri_dung_trong_nhan_khoa_dung_cu_thong_ap_luc_noi_nhan_trong_phau_thuat_glocom_">Thiết bị và dụng cụ nhãn khoa khác (ví dụ: máy đo khúc xạ, giác mạc tự động; máy đo điện võng mạc; máy chụp cắt lớp đáy mắt, máy chụp huỳnh quang đáy mắt; hệ thống phẫu thuật chuyên ngành nhãn khoa (laser excimer, phemtosecond laser, phaco, máy cắt dịch kính, máy cắt vạt giác mạc); máy laser Điều trị dùng trong nhãn khoa; dụng cụ thông áp lực nội nhãn trong phẫu thuật glôcôm...)</option>
                                                                    <option value="bo_theo_doi_tinh_mach_may_soi_tinh_mach">Bộ theo dõi tĩnh mạch, máy soi tĩnh mạch</option>
                                                                    <option value="dung_cu_va_thiet_bi_dien_tu_dung_cho_nganh_y_phau_thuat_nha_khoa_vi_du_may_pha_rung_tim_dao_mo_dien_dao_mo_sieu_am_dao_mo_laser_may_gay_me_kem_tho_may_giup_tho_long_ap_tre_so_sinh_he_thong_tan_soi_thiet_bi_loc_mau_thiet_bi_phau_thuat_lanh_may_tim_phoi_nhan_tao_may_loc_gan_may_chay_than_nhan_tao_may_tham_phan_phuc_mac_cho_benh_nhan_suy_than_he_thong_phau_thuat_tien_liet_tuyen_">Dụng cụ và thiết bị điện tử dùng cho ngành y, phẫu thuật, nha khoa (ví dụ: máy phá rung tim; dao mổ điện; dao mổ siêu âm; dao mổ laser; máy gây mê kèm thở; máy giúp thở; lồng ấp trẻ sơ sinh; hệ thống tán sỏi; thiết bị lọc máu; thiết bị phẫu thuật lạnh; máy tim phổi nhân tạo; máy lọc gan; máy chạy thận nhân tạo, máy thẩm phân phúc mạc cho bệnh nhân suy thận; hệ thống phẫu thuật tiền liệt tuyến...)</option>
                                                                    <option value="thiet_bi_va_dung_cu_dung_cho_nganh_y_thuoc_nhom_9018_nhung_chua_duoc_dinh_danh_cu_the_trong_danh_muc_hang_hoa_xuat_nhap_khau_viet_nam_va_danh_muc_ban_hanh_kem_thong_tu_nay_">Thiết bị và dụng cụ dùng cho ngành y thuộc nhóm 9018 nhưng chưa được định danh cụ thể trong Danh Mục hàng hóa xuất nhập khẩu Việt Nam và Danh Mục ban hành kèm Thông tư này</option>
                                                                    <option value="cac_dung_cu_chinh_hinh_hoac_dinh_nep_vit_xuong">Các dụng cụ chỉnh hình hoặc đinh, nẹp, vít xương</option>
                                                                    <option value="rang_gia">Răng giả</option>
                                                                    <option value="chi_tiet_gan_dung_trong_nha_khoa">Chi Tiết gắn dùng trong nha khoa</option>
                                                                    <option value="khop_gia">Khớp giả</option>
                                                                    <option value="cac_bo_phan_nhan_tao_khac_cua_co_the">Các bộ phận nhân tạo khác của cơ thể</option>
                                                                    <option value="thiet_bi_tro_thinh_tru_cac_bo_phan_va_phu_kien">Thiết bị trợ thính, trừ các bộ phận và phụ kiện</option>
                                                                    <option value="thiet_bi_dieu_hoa_nhip_tim_dung_cho_viec_kich_thich_co_tim_tru_cac_bo_phan_va_phu_kien">Thiết bị Điều hòa nhịp tim dùng cho việc kích thích cơ tim, trừ các bộ phận và phụ kiện</option>
                                                                    <option value="dung_cu_khac_duoc_lap_hoac_mang_theo_hoac_cay_ghep_vao_co_the_de_bu_dap_khuyet_tat_hay_su_suy_giam_cua_bo_phan_co_the_vi_du_khung_gia_do_mach_vanh_hat_nut_mach_luoi_loc_huyet_khoi_dung_cu_dong_dong_mach_thuy_tinh_the_nhan_tao">Dụng cụ khác được lắp hoặc mang theo hoặc cấy ghép vào cơ thể để bù đắp khuyết tật hay sự suy giảm của bộ phận cơ thể (ví dụ: khung giá đỡ mạch vành, hạt nút mạch, lưới lọc huyết khối, dụng cụ đóng động mạch; thủy tinh thể nhân tạo...)</option>
                                                                    <option value="thiet_bi_chup_cat_lop_ct_dieu_khien_bang_may_tinh">Thiết bị chụp cắt lớp (CT) Điều khiển bằng máy tính</option>
                                                                    <option value="thiet_bi_chan_doan_hoac_dieu_tri_su_dung_trong_nha_khoa">Thiết bị chẩn đoán hoặc Điều trị sử dụng trong nha khoa</option>
                                                                    <option value="thiet_bi_su_dung_tia_x_dung_chan_doan_hoac_dieu_tri_su_dung_cho_muc_dich_y_hoc_phau_thuat">Thiết bị sử dụng tia X dùng chẩn đoán hoặc Điều trị sử dụng cho Mục đích y học, phẫu thuật</option>
                                                                    <option value="thiet_bi_su_dung_tia_alpha_beta_hay_gamma">Thiết bị sử dụng tia alpha, beta hay gamma dùng cho Mục đích y học, phẫu thuật, nha khoa kể cả thiết bị chụp hoặc thiết bị Điều trị bằng các loại tia đó (ví dụ: máy Coban Điều trị ung thư, máy gia tốc tuyến tính Điều trị ung thư, dao mổ gamma các loại, thiết bị xạ trị áp sát;...)</option>
                                                                    <option value="thiet_bi_su_dung_tia_alpha_beta_hay_gamma_dung_cho_muc_dich_y_hoc_phau_thuat_nha_khoa_ke_ca_thiet_bi_chup_hoac_thiet_bi_dieu_tri_bang_cac_loai_tia_do_vi_du_may_coban_dieu_tri_ung_thu_may_gia_toc_tuyen_tinh_dieu_tri_ung_thu_dao_mo_gamma_cac_loai_thiet_bi_xa_tri_ap_sat">Thiết bị sử dụng tia alpha, beta hay gamma dùng cho Mục đích y học, phẫu thuật, nha khoa kể cả thiết bị chụp hoặc thiết bị Điều trị bằng các loại tia đó (ví dụ: máy Coban Điều trị ung thư, máy gia tốc tuyến tính Điều trị ung thư, dao mổ gamma các loại, thiết bị xạ trị áp sát;...)</option>
                                                                    <option value="thiet_bi_chan_doan_bang_dong_vi_phong_xa_he_thong_pet_spect_thiet_bi_do_do_tap_trung_iot_i130_i131">Thiết bị chẩn đoán bằng đồng vị phóng xạ (hệ thống PET, SPECT, thiết bị đo độ tập trung iốt I130, I131)</option>
                                                                    <option value="nhiet_ke_dien_tu">Nhiệt kế điện tử</option>
                                                                    <option value="nhiet_ke_y_hoc_thuy_ngan">Nhiệt kế y học thủy ngân</option>
                                                                    <option value="thiet_bi_phan_tich_ly_hoac_hoa_hoc_hoat_dong_bang_dien_dung_cho_muc_dich_y_hoc_vi_du_may_phan_tich_sinh_hoa_may_phan_tich_dien_giai_khi_mau_may_phan_tich_huyet_hoc_may_do_dong_mau_may_do_toc_do_mau_lang_he_thong_xet_nghiem_elisa_may_phan_tich_nhom_mau_may_chiet_tach_te_bao_may_do_ngung_tap_va_phan_tich_chuc_nang_tieu_cau_may_dinh_danh_vi_rut_vi_khuan_may_phan_tich_mien_dich_may_do_tai_luong_vi_khuan_vi_rut_may_do_duong_huyet_">Thiết bị phân tích lý hoặc hóa học hoạt động bằng điện dùng cho Mục đích y học (ví dụ: máy phân tích sinh hóa; máy phân tích điện giải, khí máu; máy phân tích huyết học; máy đo đông máu; máy đo tốc độ máu lắng; hệ thống xét nghiệm elisa; máy phân tích nhóm máu; máy chiết tách tế bào; máy đo ngưng tập và phân tích chức năng tiểu cầu; máy định danh vi rút, vi khuẩn; máy phân tích miễn dịch; máy đo tải lượng vi khuẩn, vi rút; máy đo đường huyết...)</option>
                                                                    <option value="ghe_nha_khoa_va_cac_bo_phan_cua_chung">Ghế nha khoa và các bộ phận của chúng</option>
                                                                    <option value="ghe_ve_sinh_danh_cho_nguoi_benh">Ghế vệ sinh dành cho người bệnh</option>
                                                                    <option value="den_mo_treo_tran">Đèn mổ treo trần</option>
                                                                    <option value="den_mo_de_ban_giuong">Đèn mổ để bàn, giường</option>
                                                                    <option value="den_kham">Đèn khám</option>
                                                                    <option value="den_phau_thuat">Đèn phẫu thuật</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                       <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Thuộc chuyên khoa</label>
                                                                <select class="form-control" id="dskhoa">
                                                                    @if(isset($dskhoa))
                                                                    @foreach($dskhoa as $khoa)
                                                                        <option value="{{$khoa->IdKhoa}}">{{$khoa->TenKhoa}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">  
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Phòng ban (<span class="color-red">*</span>)</label>
                                                                <select class="form-control" id="dsphong">
                                                                            
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class=" form-control-label">Tình trạng thiết bị</label>
                                                                <select class="form-control" id="tttb">
                                                                    <option value="hoat_dong_tot">Hoạt động tốt</option>
                                                                    <option value="hong_mot_phan">Hỏng một phần</option>
                                                                    <option value="hong_hoan_toan">Hỏng hoàn toàn</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-b-15">
                                                        @if($nd->Quyen != 'admin' && $flag == FALSE)
                                                        <div class="col-lg-1" id="btnthemarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Thêm mới" id="btnthem"><span class="fa fa-plus"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 hidden" id="btnsuaarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--submit au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Cập nhật" id="btncapnhat"><span class="fa fa-edit"></span></button>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-1" id="btnlamlaiarea">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--remove au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Làm lại" id="btnlamlai"><span class="fa fa-eraser"></span></button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-lg-1">
                                                            <div class="form-group">
                                                                <button type="button" class="au-btn au-btn--close au-btn--small au-btn-shadow height-43px" data-toggle="tooltip" title="Đóng" id="btndong"><span class="fa fa-remove"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END THÊM MỚI THÔNG TIN DƯỢC-->

                <!-- DATA TABLE-->
                <section class="p-t-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="m-b-35">
                                    <h3 class="title-5 font-weight-bold text-green">DANH SÁCH TRANG THIẾT BỊ Y TẾ</h3>
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
                                        <button class="au-btn au-btn--darkyellow au-btn--small au-btn-shadow height-40px" data-toggle="tooltip" title="Thêm mới" id="btnadd"><i class="fa fa-wheelchair"></i></button>
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
                                <div class="table-responsive table-responsive-data2 fit_table_height_500 tableFixHead">
                                    <table class="table table-data2 table-hover m-b-20 text-center">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox" data-input="checksum">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th style="position: sticky; top: 0; z-index: 99;">Tên thiết bị</th>
                                                <th>nhà sản xuất</th>
                                                <th>nhà cung ứng</th>
                                                <th>ngày nhập</th>
                                                <th>đơn giá nhập</th>
                                                <th>chức năng</th>
                                                <th>phân loại</th>
                                                <th>Số thiết bị</th>
                                                <th>Tình trạng thiết bị</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbl_tb">
                                            @if(isset($dstb))
                                            @foreach($dstb as $tb)
                                            <tr class="tr-shadow">
                                                <td style="vertical-align: middle;">
                                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">
                                                        <input type="checkbox" data-input="check" data-id="{{ $tb->IdTB }}" data-name="{{ $tb->TenTB }}">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{$tb->TenTB}}</td>
                                                <td>{{$tb->NSX}}</td>
                                                <td>{{$tb->NCU}}</td>
                                                <td>{{date('d/m/Y', strtotime($tb->NgayNhap))}}</td>
                                                <td>{{number_format($tb->DonGiaNhap)}} VNĐ</td>
                                                <td>{{$tb->ChucNang}}</td>
                                                <td>{{\comm_functions::decodeLoaiTB($tb->PhanLoai)}}</td>
                                                <td>{{$tb->SoTB}}</td>
                                                <td>
                                                    @if($tb->TTTB == 'hoat_dong_tot')
                                                        Hoạt động tốt
                                                    @elseif($tb->TTTB == 'hong_mot_phan')
                                                        Hỏng một phần
                                                    @else
                                                        Hỏng hoàn toàn
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Sửa" data-button="sua" data-id="{{ $tb->IdTB }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Xóa" data-button="xoa" data-id="{{ $tb->IdTB }}" data-name="{{ $tb->TenTB}}">
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
                </section>
                <!-- END DATA TABLE-->
            </div>
@endsection

@section('js')
<script src="public/js/moment.js"></script>
<script src="public/js/tempusdominus-bootstrap-4.js"></script>
<script src="public/js/pusher.js"></script>
<script>

    $(function () {
        //khởi tạo flag tìm kiếm
        var tk=false, keySearch='', soluongtk=0, soluongl=0, locds=false;
        //end

        if ($("#dtpngaynhap").length) {
            $('#dtpngaynhap').datetimepicker({
                icons: {
                        time: "far fa-clock",
                        date: "fa fa-calendar-alt",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },

                allowInputToggle: true,
                format: 'DD/MM/YYYY'
            });
        }
        
        $('#ngaynhap').on('input', function (){
           $('#dtpngaynhap').datetimepicker('minDate', '01/01/1900 00:00');
           $('#dtpngaynhap').datetimepicker('maxDate', new Date());
        });

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
        var channelnhantb = pusher.subscribe('DVB');
        
        function nhantbbc(data) {
            if(data.thaotac != 'xoa'){
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
                    }
                    else if(data.dvb.idnv == $('#id_nv').val()){
                        if(data.dvb.pl == 'thong_ke'){
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
                        }
                    }
                }
            }
            else{
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

                if($.isArray(data.dvb)){
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
            }
        }

        channelnhantb.bind('App\\Events\\HanhChinh\\DVB', nhantbbc);
        
        var channel = pusher.subscribe('TTB');
        function laytt(data) {
            if(data.thaotac != 'xoa'){
                var tb='\n\
                    <tr class="tr-shadow">\n\
                        <td style="vertical-align: middle;">\n\
                            <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                <input type="checkbox" data-input="check" data-id="'+data.tb.id+'" data-name="'+data.tb.tentb+'">\n\
                                <span class="au-checkmark"></span>\n\
                            </label>\n\
                        </td>\n\
                        <td>'+data.tb.tentb+'</td>\n\
                        <td>'+data.tb.nsx+'</td>\n\
                        <td>'+data.tb.ncu+'</td>\n\
                        <td>'+data.tb.ngaynhap+'</td>\n\
                        <td>'+data.tb.dgn+'</td>\n\
                        <td>'+data.tb.cn+'</td>\n\
                        <td>'+data.tb.pl+'</td>\n\
                        <td>'+data.tb.sotb+'</td>\n\
                        <td>'+data.tb.tttb+'</td>\n\
                        <td>\n\
                            <div class="table-data-feature">\n\
                                <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.tb.id+'">\n\
                                    <i class="zmdi zmdi-edit"></i>\n\
                                </button>\n\
                                <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.tb.id+'" data-name="'+data.tb.tentb+'">\n\
                                    <i class="zmdi zmdi-delete"></i>\n\
                                </button>\n\
                            </div>\n\
                        </td>\n\
                    </tr>';
                if(data.thaotac == 'them'){
                    tb+='<tr class="spacer"></tr>';
                    $('#tbl_tb').prepend(tb);
                }
                else{

                    $('#tbl_tb tr').has('td div button[data-id="'+data.tb.id+'"]').replaceWith(tb);
                }

                $('button[data-id="'+data.tb.id+'"]').tooltip({
                    trigger: 'manual'

                })
                .focus(hideTooltip)
                .blur(hideTooltip)
                .hover(showTooltip, hideTooltip);
            }
            else{
                if($.isArray(data.tb)){
                    for (var i = 0; i < data.tb.length; i++) {
                        $('#tbl_tb tr').has('td div button[data-id="'+data.tb[i]+'"]').next('tr.spacer').remove();
                        $('#tbl_tb tr').has('td div button[data-id="'+data.tb[i]+'"]').remove();

                    }
                }
                else{
                    $('#tbl_tb tr').has('td div button[data-id="'+data.tb+'"]').next('tr.spacer').remove();
                    $('#tbl_tb tr').has('td div button[data-id="'+data.tb+'"]').remove();

                }
            }
        }

        channel.bind('App\\Events\\HanhChinh\\TTB', laytt);
        //end xử lý channel
        
        $('#dskhoa').change(function (e, dt){
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).val());
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/lay_ds_pb',
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
                        $('#dsphong').html(data.ds);
                        if(!$.isEmtyObject(dt)){
                            $('#dsphong').val(dt);
                        }
                        
                    }
                    else{
                        alert("Lấy danh sách phòng ban thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy danh sách phòng ban thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy danh sách phòng ban thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy danh sách phòng ban thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        
        //Submit thêm mới
        $('#btnthem').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
               
            var tentb=$('#tentb').val(), nsx=$('#nsx').val(), ncu=$('#ncu').val(), pl=$('#pl').val(), ngaynhap=$('#ngaynhap').val(), dgn=$('#dgn').val(), cn=$('#cn').val(), tttb=$('#tttb').val(), dsphong=$('#dsphong').val();
            
            if(tentb.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên thiết bị!");
                return false;
            }
            else if(nsx.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà sản xuất!");
                return false;
            }
            else if(ncu.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà cung ứng!");
                return false;
            }
            else if(cn.toString().trim() == ''){
                alert("Vui lòng nhập chức năng của thiết bị!");
                return false;
            }
            else if(dgn.toString().trim() == '' || parseInt(dgn) == 0){
                alert("Vui lòng nhập đơn giá nhập!");
                return false;
            }
            if($('#dsphong').children().length == 0){
                alert('Chưa chọn phòng!');
                return false;
            }
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('tentb', tentb.toString().trim());
            formData.append('nsx', nsx);
            formData.append('ncu', ncu);
            formData.append('dgn', dgn);
            formData.append('cn', cn);
            formData.append('tttb', tttb);
            formData.append('pb', dsphong);
            formData.append('ngaynhap', ngaynhap);
            formData.append('pl', pl);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/them_moi',
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
                        alert("Thêm thông tin thiết bị mới thành công!");
                        $('input[data-input="checksum"]').prop("checked",false);
                        $('input[data-input="check"]').prop("checked",false);

                        $('#kqtimliem').text("");
                        tk=false;locds=false;keySearch='';
                    }
                    else{
                        alert("Thêm thông tin thiết bị mới thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Thêm thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Thêm thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Thêm thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        // end Submit thêm mới

        //Submit cập nhật
        $('#btncapnhat').click(function(){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);

            var id=$(this).attr('data-id');
            
            var tentb=$('#tentb').val(), nsx=$('#nsx').val(), ncu=$('#ncu').val(), pl=$('#pl').val(), ngaynhap=$('#ngaynhap').val(), dgn=$('#dgn').val(), cn=$('#cn').val(), tttb=$('#tttb').val(), dsphong=$('#dsphong').val();
            
            if(tentb.toString().trim() == ''){
                alert("Vui lòng nhập thông tin tên thiết bị!");
                return false;
            }
            else if(nsx.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà sản xuất!");
                return false;
            }
            else if(ncu.toString().trim() == ''){
                alert("Vui lòng nhập tên nhà cung ứng!");
                return false;
            }
            else if(cn.toString().trim() == ''){
                alert("Vui lòng nhập chức năng của thiết bị!");
                return false;
            }
            else if(dgn.toString().trim() == '' || parseInt(dgn) == 0){
                alert("Vui lòng nhập đơn giá nhập!");
                return false;
            }
            if($('#dsphong').children().length == 0){
                alert('Chưa chọn phòng!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', id);
            formData.append('tentb', tentb.toString().trim());
            formData.append('nsx', nsx);
            formData.append('ncu', ncu);
            formData.append('dgn', dgn);
            formData.append('cn', cn);
            formData.append('tttb', tttb);
            formData.append('pb', dsphong);
            formData.append('ngaynhap', ngaynhap);
            formData.append('pl', pl);
            
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/cap_nhat',
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
                        alert("Cập nhật thông tin thiết bị thành công!");
                    }
                    else{
                        alert("Cập nhật thông tin thiết bị thất bại! Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Cập nhật thông tin thiết bị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Cập nhật thông tin thiết bị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Cập nhật thông tin thiết bị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end Submit cập nhật

        //đóng form nhập liệu
        $('#btndong').click(function(){
            $('#formttb').slideUp(800);
        });
        //end đóng form nhập liệu
        
        //mở form để thêm
        $('#btnadd').click(function(){
            $('#btnthemarea').fadeIn(800);
            $('#btnlamlaiarea').fadeIn(800);
            $('#btnsuaarea').fadeOut(800);
            $('#formtitle').text('THÊM THÔNG TIN TRANG THIẾT BỊ Y TẾ MỚI');
            $('#btnlamlai').click();
            $('#dskhoa').trigger('change', null);
            $('#formttb').slideDown(800);
            $('html, body').animate({
                scrollTop: $("#formttb").offset().top
            }, 800);
        });
        //end mở form để thêm

        //xóa
        $('#tbl_tb').on('click', 'button[data-button="xoa"]', function(){
            var id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            var cf=confirm("Bạn có thực sự muốn xóa thông tin của thiết bị "+name+"?");
            if(cf==true){
                if($('#btnsuaarea').css('display') == 'block' && id == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                   $('#btndong').click();
                }
                var formData = new FormData();
                formData.append('_token', CSRF_TOKEN);
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/xoa',
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
                                    $('#kqtimliem').text("Có "+soluongl+" thiết bị được tìm thấy!");
                                }
                            }
                            else{
                                if(tk == true){
                                    soluongtk--;
                                    if(soluongtk == 0){
                                        $('#kqtimliem').text("");
                                    }
                                    else{
                                        $('#kqtimliem').text("Có "+soluongtk+" thiết bị được tìm thấy!");
                                    }
                                }
                            }
                            if($('#tbl_tb').children().length == 0){
                                $('input[data-input="checksum"]').prop("checked",false);
                            }
                            alert("Xóa thông tin thiết bị thành công!");
                        }
                        else{
                            alert("Xóa thông tin thiết bị thất bại! Lỗi: "+data.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 419){
                            alert("Xóa thông tin thiết bị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                        }
                        else if(jqXHR.status == 500){
                            alert("Xóa thông tin thiết bị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                        }
                        else{
                            alert("Xóa thông tin thiết bị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                        }
                    }
                });
            }
        });
        //end xóa 

        //mở form để sửa
        $('#tbl_tb').on('click','button[data-button="sua"]',function(){
            $('#tttb').removeAttr('disabled','');
            $('#btnthemarea').fadeOut(800);
            $('#btnlamlaiarea').fadeOut(800);
            $('#btnsuaarea').fadeIn(800);
            $('#formtitle').text('CẬP NHẬT THÔNG TIN TRANG THIẾT BỊ Y TẾ');

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('id', $(this).attr('data-id'));
            $('#btncapnhat').attr('data-id',$(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/lay_tt_cap_nhat',
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
                        $('#tentb').val(data.tentb); $('#nsx').val(data.nsx); $('#ncu').val(data.ncu); $('#pl').val(data.pl); $('#ngaynhap').val(data.ngaynhap); $('#dgn').val(data.dgn); $('#cn').val(data.cn); $('#tttb').val(data.tttb); $('#dskhoa').val(data.khoa); $('#dskhoa').trigger('change', [data.phong]);
                        
                        $('#formttb').slideDown(800);
                        $('html, body').animate({
                            scrollTop: $("#formttb").offset().top
                        }, 800);
                    }
                    else{
                        alert("Lấy dữ liệu thất bại. Lỗi: "+data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if(jqXHR.status == 419){
                        alert("Lấy dữ liệu thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                    }
                    else if(jqXHR.status == 500){
                        alert("Lấy dữ liệu thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                    }
                    else{
                        alert("Lấy dữ liệu thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                    }
                }
            });
        });
        //end mở form để sửa

        //tìm kiếm
        $('#btntimkiem').click(function (){
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            if($('#txttimkiem').val().toString().trim() == ''){
                alert('Vui lòng nhập thông tin tìm kiếm!');
                return false;
            }

            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);
            formData.append('keyWords', $('#txttimkiem').val());

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/tim_kiem',
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
                            var tb='';
                            for(var i=0; i<data.tb.length; ++i){
                                tb+='\n\
                                <tr class="tr-shadow">\n\
                                    <td style="vertical-align: middle;">\n\
                                        <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                            <input type="checkbox" data-input="check" data-id="'+data.tb[i].id+'" data-name="'+data.tb[i].tentb+'">\n\
                                            <span class="au-checkmark"></span>\n\
                                        </label>\n\
                                    </td>\n\
                                    <td>'+data.tb[i].tentb+'</td>\n\
                                    <td>'+data.tb[i].nsx+'</td>\n\
                                    <td>'+data.tb[i].ncu+'</td>\n\
                                    <td>'+data.tb[i].ngaynhap+'</td>\n\
                                    <td>'+data.tb[i].dgn+'</td>\n\
                                    <td>'+data.tb[i].cn+'</td>\n\
                                    <td>'+data.tb[i].pl+'</td>\n\
                                    <td>'+data.tb[i].sotb+'</td>\n\
                                    <td>'+data.tb[i].tttb+'</td>\n\
                                    <td>\n\
                                        <div class="table-data-feature">\n\
                                            <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.tb[i].id+'">\n\
                                                <i class="zmdi zmdi-edit"></i>\n\
                                            </button>\n\
                                            <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.tb[i].id+'" data-name="'+data.tb[i].tentb+'">\n\
                                                <i class="zmdi zmdi-delete"></i>\n\
                                            </button>\n\
                                        </div>\n\
                                    </td>\n\
                                </tr>\n\
                                <tr class="spacer"></tr>';
                            }
                            $('#tbl_tb').html(tb);
                            $('button[data-button]').tooltip({
                                trigger: 'manual'
                            })
                            .focus(hideTooltip)
                            .blur(hideTooltip)
                            .hover(showTooltip, hideTooltip);

                            tk=true;keySearch=$('#txttimkiem').val();
                            $('#kqtimliem').text("Có "+data.sl+" thiết bị được tìm thấy!");
                        }
                        else{
                            $('#tbl_tb').html("");
                            $('#kqtimliem').text("Không có thiết bị nào được tìm thấy!");tk=false;
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
            $('input[data-input="checksum"]').prop("checked",false);
            $('input[data-input="check"]').prop("checked",false);
            
            var formData = new FormData();
            formData.append('_token', CSRF_TOKEN);

            $.ajax({
                type: 'POST',
                dataType: "JSON",
                url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/lay_ds_tb',
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
                        alert("Lỗi khi tải danh sách thuốc! Mô tả: "+data.msg);
                    }else{
                        var tb='';
                        for(var i=0; i<data.tb.length; ++i){
                            tb+='\n\
                            <tr class="tr-shadow">\n\
                                <td style="vertical-align: middle;">\n\
                                    <label class="au-checkbox" style="margin-top: 0; margin-bottom: 20px;">\n\
                                        <input type="checkbox" data-input="check" data-id="'+data.tb[i].id+'" data-name="'+data.tb[i].tentb+'">\n\
                                        <span class="au-checkmark"></span>\n\
                                    </label>\n\
                                </td>\n\
                                <td>'+data.tb[i].tentb+'</td>\n\
                                <td>'+data.tb[i].nsx+'</td>\n\
                                <td>'+data.tb[i].ncu+'</td>\n\
                                <td>'+data.tb[i].ngaynhap+'</td>\n\
                                <td>'+data.tb[i].dgn+'</td>\n\
                                <td>'+data.tb[i].cn+'</td>\n\
                                <td>'+data.tb[i].pl+'</td>\n\
                                <td>'+data.tb[i].sotb+'</td>\n\
                                <td>'+data.tb[i].tttb+'</td>\n\
                                <td>\n\
                                    <div class="table-data-feature">\n\
                                        <button class="item" data-button="sua" data-toggle="tooltip" data-placement="top" title="Sửa" data-id="'+data.tb[i].id+'">\n\
                                            <i class="zmdi zmdi-edit"></i>\n\
                                        </button>\n\
                                        <button class="item" data-button="xoa" data-toggle="tooltip" data-placement="top" title="Xóa" data-id="'+data.tb[i].id+'" data-name="'+data.tb[i].tentb+'">\n\
                                            <i class="zmdi zmdi-delete"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </td>\n\
                            </tr>\n\
                            <tr class="spacer"></tr>';
                        }

                        $('#tbl_tb').html(tb);
                        $('#tbl_tb button[data-id]').tooltip({
                            trigger: 'manual'

                        })
                        .focus(hideTooltip)
                        .blur(hideTooltip)
                        .hover(showTooltip, hideTooltip);

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

        //reset input
        $('#btnlamlai').click(function(){
            $('#tentb').val(''); $('#nsx').val(''); $('#ncu').val(''); $('#dgn').val(''); $('#cn').val(''); $('#tttb').attr('disabled', ''); $('#tttb').val('hoat_dong_tot');
            var d=new Date();
            var s = (d.getDate() < 10 ? '0'+d.getDate() : d.getDate())+"/"+((d.getMonth()+1) < 10 ? ('0'+(d.getMonth()+1)) : (d.getMonth()+1))+"/"+d.getFullYear()+" ";
            $('#ngaynhap').val(s);
        });
        //end

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
        $('body').on('change', 'input[data-input="checksum"]', function(){
            if($(this).prop("checked")){
                $('input[data-input="check"]').prop("checked",true);
            }
            else{
                $('input[data-input="check"]').prop("checked",false);
            }
        });
        //end

        //click check
        $('#tbl_tb').on('change', 'input[data-input="check"]', function(){
            if(!$(this).prop("checked")){
                $('input[data-input="checksum"]').prop("checked",false);
            }
            else{
                if($('input[data-input="check"]:checked').length == $('input[data-input="check"]').length){
                    $('input[data-input="checksum"]').prop("checked",true);
                }
            }
        });
        //end

        //Xóa các đối tượng đã chọn
        $('#btnxoatc').click(function(){
            if(!$('input[data-input="check"]').is(":checked")){
                alert("Bạn chưa chọn thiết bị để xóa!");
                return false;
            }
            else{
               var name='';var arr=[],arr_name=[];
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
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của các thiết bị "+name+"?");
                }
                else
                {
                    cf=confirm("Bạn có thực sự muốn xóa thông tin của thiết bị "+name+"?");
                }
                if(cf==true){
                    for (var i = 0; i < arr.length; i++) {
                        if($('#btnsuaarea').css('display') == 'block' && arr[i] == $('#btncapnhat').attr('data-id')){//đóng form sửa khi click xóa
                           $('#btndong').click();
                           break;
                        }
                    }
                    
                    var formData = new FormData();
                    formData.append('_token', CSRF_TOKEN);
                    formData.append('id', arr);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: '/qlkcb/hanh_chinh/quan_ly_trang_thiet_bi_yt/xoa',
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
                                            $('#kqtimliem').text("Có "+soluongl+" thiết bị được tìm thấy!");
                                        }
                                    }
                                    else{
                                        if(tk == true){
                                            soluongtk = soluongtk - arr.length;
                                            if(soluongtk == 0)
                                            {
                                                $('#kqtimliem').text("");
                                            }
                                            else
                                            {
                                                $('#kqtimliem').text("Có "+soluongtk+" thiết bị được tìm thấy!");
                                            }
                                        }
                                    }
                                    if($('#tbl_tb').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin các thiết bị thành công!");
                                }
                                else
                                {
                                    if(locds == true){
                                        $('#kqtimliem').text("Có "+(soluongl - 1)+" thiết bị được tìm thấy!");
                                    }
                                    else{
                                        if(tk == true){
                                            $('#kqtimliem').text("Có "+(soluongtk - 1)+" thiết bị được tìm thấy!");
                                        }
                                    }
                                    if($('#tbl_tb').children().length == 0){
                                        $('input[data-input="checksum"]').prop("checked",false);
                                    }
                                    alert("Xóa thông tin thiết bị thành công!");
                                }
                            }
                            else{
                                if(arr.length > 1)
                                {
                                    alert("Xóa thông tin các thiết bị thất bại! Lỗi: "+data.msg);
                                }
                                else
                                {
                                    alert("Xóa thông tin thiết bị thất bại! Lỗi: "+data.msg);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if(arr.length > 1)
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin các thiết bị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin các thiết bị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin các thiết bị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                            else
                            {
                                if(jqXHR.status == 419){
                                    alert("Xóa thông tin thiết bị thất bại! Người dùng không được xác thực (có thể đã đăng xuất).");
                                }
                                else if(jqXHR.status == 500){
                                    alert("Xóa thông tin thiết bị thất bại! Đã phát hiện lỗi trên máy chủ phục vụ.");
                                }
                                else{
                                    alert("Xóa thông tin thiết bị thất bại! Lỗi: "+jqXHR.responseText+" | "+textStatus+" | "+errorThrown);
                                }
                            }
                        }
                    });
                }

            }
        });
        //end
        
        $("input[type='number']").on("keypress", function (evt) {
            if (evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
        
    });
    </script>
@endsection