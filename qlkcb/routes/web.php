<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('a', function (Request $request){
echo DNS1D::getBarcodesHTML(123, "C128", 1.3, 25);
});

Route::post('reset_password', 'MailController@send');

Route::get('reset_password', function () {
    return view('reset_password');
});

Route::get('cap_nhat_tai_khoan', "MailController@getCNTK");

Route::post('cap_nhat_tai_khoan', "MailController@postCNTK");

Route::get('/', 'Auth\\LoginController@getDN');

Route::post('/', 'Auth\\LoginController@postDN');

Route::get('dangxuat', 'Auth\\LogOutController@getDX');

Route::group(["prefix"=>"admin", "middleware"=>"UserAdminLogin"], function (){

    Route::get("", "Admin\\HomeController@getIndex");

    Route::group(["prefix"=>"quan_ly_nguoi_dung"], function (){

        Route::get("", "Admin\\UserController@getDanhSach");//

        Route::post("them_moi", "Admin\\UserController@postThem");
        
        Route::post("cap_nhat", "Admin\\UserController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "Admin\\UserController@postLayTTCN");
        
        Route::post("xoa", "Admin\\UserController@postXoa");
        
        Route::post("tim_kiem", "Admin\\UserController@postTimKiem");
        
        Route::post("lay_ds_nd", "Admin\\UserController@postLayDSND");
    });
});

Route::group(["prefix"=>"ke_toan", "middleware"=>"UserKTLogin"], function (){
    
    Route::get("", "KeToan\\HomeController@getIndex");
    
    Route::group(["prefix"=>"duyet_van_ban"], function (){

        Route::get("", "HanhChinh\\DVBController@getDanhSachKT");//

        Route::post("duyet", "HanhChinh\\DVBController@postThem");
        
        Route::post("xem_ct", "HanhChinh\\DVBController@postSua");
        
        Route::post("xoa", "HanhChinh\\DVBController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\DVBController@postTimKiem");
        
        Route::post("lay_ds", "HanhChinh\\DVBController@postLayDS");
    });

    Route::group(["prefix"=>"thong_ke"], function (){
        
        Route::get("", "KeToan\\thongkeController@getDanhSach");//
        
        Route::post("them_tk", "KeToan\\thongkeController@postLocDS");//
    });
    
    Route::group(["prefix"=>"tam_ung"], function (){

        Route::get("", "KeToan\\tamUngController@getDanhSach");//
        
        Route::post("xn_tu", "KeToan\\tamUngController@postXNTU");
        
        Route::post("lay_tt", "KeToan\\tamUngController@postLayTT");
        
        Route::post("tim_kiem", "KeToan\\tamUngController@postTimKiem");
        
        Route::post("lay_ds_tu", "KeToan\\tamUngController@postLayDSTU");
    });
    
    Route::group(["prefix"=>"lich_su_tam_ung"], function (){

        Route::get("", "KeToan\\tamUngController@getDanhSachLS");//
        
        Route::post("tim_kiem", "KeToan\\tamUngController@postTimKiemLS");
        
        Route::post("xoa", "KeToan\\tamUngController@postXoa");
        
        Route::post("lay_ds_tu", "KeToan\\tamUngController@postLayDSTULS");
    });
    
    Route::group(["prefix"=>"hoa_don_dv"], function (){

        Route::get("", "KeToan\\HDDVController@getDanhSach");//
        
        Route::post("them_moi", "KeToan\\HDDVController@postThem");
        
        Route::post("lay_tt", "KeToan\\HDDVController@postLayTT");
        
        Route::post("xoa", "KeToan\\HDDVController@postXoa");
        
        Route::post("tim_kiem", "KeToan\\HDDVController@postTimKiem");
        
        Route::post("lay_ds_hd", "KeToan\\HDDVController@postLayDS");
    });
    
});

Route::group(["prefix"=>"hanh_chinh", "middleware"=>"UserHCLogin"], function (){
    
    Route::get("", "HanhChinh\\HomeController@getIndex");

    Route::post("up_file", "HanhChinh\\HomeController@postUpFile");
    
    Route::group(["prefix"=>"thong_ke_thuoc_ton_kho"], function (){
        
        Route::get("", "HanhChinh\\thongkeController@getDanhSach");//
        
        Route::post("them_tk", "HanhChinh\\thongkeController@postLocDS");//
        
    });
    
    Route::group(["prefix"=>"ke_khai_tien_luong"], function (){
        
        Route::get("", "HanhChinh\\KKLController@getDanhSach");//
        
        Route::post("them_tk", "HanhChinh\\KKLController@postKKL");//
    });

    Route::group(["prefix"=>"quan_ly_cham_cong"], function (){

        Route::get("", "HanhChinh\\QLCCController@getDanhSach");//

        Route::post("tinh_luong", "HanhChinh\\QLCCController@postTinhLuong");

        Route::post("lay_tt_cap_nhat", "HanhChinh\\QLCCController@postLayTTCN");
        
        Route::post("cap_nhat", "HanhChinh\\QLCCController@postSua");

        Route::post("kt_snc", "HanhChinh\\QLCCController@postKTSNC");
        
        Route::post("xoa", "HanhChinh\\QLCCController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\QLCCController@postTimKiem");
        
        Route::post("lay_ds", "HanhChinh\\QLCCController@postLayDS");
    });

    Route::group(["prefix"=>"duyet_van_ban"], function (){

        Route::get("", "HanhChinh\\DVBController@getDanhSach");//

        Route::post("duyet", "HanhChinh\\DVBController@postThem");
        
        Route::post("xoa", "HanhChinh\\DVBController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\DVBController@postTimKiem");
        
        Route::post("lay_ds", "HanhChinh\\DVBController@postLayDS");
    });
    
    Route::group(["prefix"=>"quan_ly_thong_tin_dia_phuong", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\TTDPController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\TTDPController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\TTDPController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\TTDPController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\TTDPController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\TTDPController@postTimKiem");
        
        Route::post("lay_ds_dp", "HanhChinh\\TTDPController@postLayDS");
        
    });
    
    Route::group(["prefix"=>"quan_ly_trang_thiet_bi_yt", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\TTBController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\TTBController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\TTBController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\TTBController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\TTBController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\TTBController@postTimKiem");
        
        Route::post("lay_ds_tb", "HanhChinh\\TTBController@postLayDS");

        Route::post("lay_ds_pb", "HanhChinh\\TTBController@postLayDSPB");
    });
    
    Route::group(["prefix"=>"quan_ly_danh_muc_ky_thuat", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\DMKTController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\DMKTController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\DMKTController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\DMKTController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\DMKTController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\DMKTController@postTimKiem");
        
        Route::post("lay_ds_dm", "HanhChinh\\DMKTController@postLayDS");
    });
    
    Route::group(["prefix"=>"quan_ly_danh_muc_benh", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\BenhController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\BenhController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\BenhController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\BenhController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\BenhController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\BenhController@postTimKiem");
        
        Route::post("lay_ds_benh", "HanhChinh\\BenhController@postLayDS");
    });
    
    Route::group(["prefix"=>"quan_ly_duoc", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\ThuocController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\ThuocController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\ThuocController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\ThuocController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\ThuocController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\ThuocController@postTimKiem");
        
        Route::post("lay_ds_thuoc", "HanhChinh\\ThuocController@postLayDS");
    });
    
    Route::group(["prefix"=>"quan_ly_nhan_su", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\nhanVienController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\nhanVienController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\nhanVienController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\nhanVienController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\nhanVienController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\nhanVienController@postTimKiem");
        
        Route::post("lay_ds_nv", "HanhChinh\\nhanVienController@postLayDSNV");
    });
    
    Route::group(["prefix"=>"quan_ly_khoa", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\khoaController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\khoaController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\khoaController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\khoaController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\khoaController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\khoaController@postTimKiem");
        
        Route::post("lay_ds_khoa", "HanhChinh\\khoaController@postLayDSK");
    });
    
    Route::group(["prefix"=>"quan_ly_phong_ban", "middleware"=>"HC_Access"], function (){

        Route::get("", "HanhChinh\\phongBanController@getDanhSach");//

        Route::post("them_moi", "HanhChinh\\phongBanController@postThem");
        
        Route::post("cap_nhat", "HanhChinh\\phongBanController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "HanhChinh\\phongBanController@postLayTTCN");
        
        Route::post("xoa", "HanhChinh\\phongBanController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\phongBanController@postTimKiem");
        
        Route::post("lay_ds_pb", "HanhChinh\\phongBanController@postLayDSPB");
    });
});

Route::group(["prefix"=>"kham_va_dieu_tri", "middleware"=>"UserBSKLogin"], function (){
    
    Route::get("", "KhamVaDieuTri\\HomeController@getIndex");
    
    Route::group(["prefix"=>"duyet_van_ban", "middleware"=>"QLCK_Access"], function (){

        Route::get("", "HanhChinh\\DVBController@getDanhSachKVDT");//

        Route::post("duyet", "HanhChinh\\DVBController@postThem");
        
        Route::post("xem_ct", "HanhChinh\\DVBController@postSua");
        
        Route::post("xoa", "HanhChinh\\DVBController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\DVBController@postTimKiem");
        
        Route::post("lay_ds", "HanhChinh\\DVBController@postLayDS");
    });
    
    Route::group(["prefix"=>"cap_cuu", "middleware"=>"BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\capCuuController@getDanhSach");//
        
        Route::post("them_moi", "KhamVaDieuTri\\capCuuController@postThem");//
        
        Route::post("chuyen_ba", "KhamVaDieuTri\\capCuuController@postCBA");//
        
        Route::post("xoa_ba_cn", "KhamVaDieuTri\\capCuuController@postXoaBA");//
    });
    
    Route::group(["prefix"=>"benh_su", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\benhSuController@getDanhSach");//
        
        Route::post("xem_benh_su", "KhamVaDieuTri\\benhSuController@postXBS");//
        
    });

    Route::group(["prefix"=>"thong_ke_dieu_tri", "middleware"=>"BSK_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\thongKeController@getDanhSach");//
        
        Route::post("them_tk_dt", "KhamVaDieuTri\\thongKeController@postThemTKDT");//
        
    });
    
    Route::group(["prefix"=>"thong_ke_cls", "middleware"=>"BSKT_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\thongKeController@getDanhSachCLS");//
        
        Route::post("them_tk_cls", "KhamVaDieuTri\\thongKeController@postThemTKCLS");//
        
    });
    
    Route::group(["prefix"=>"giay_ra_vien", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\giayRaVienController@getDanhSach");//

        Route::post("them_moi", "KhamVaDieuTri\\giayRaVienController@postThem");//

        Route::post("xoa", "KhamVaDieuTri\\giayRaVienController@postXoa");//

        Route::post("in", "KhamVaDieuTri\\giayRaVienController@postIn");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\giayRaVienController@postTimKiem");//
        
        Route::post("lay_ds_grv", "KhamVaDieuTri\\giayRaVienController@postLayDS");//
        
    });
    
    Route::group(["prefix"=>"giay_chuyen_vien", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\giayChuyenVienController@getDanhSach");//

        Route::post("them_moi", "KhamVaDieuTri\\giayChuyenVienController@postThem");// 
        
        Route::post("them_moi_noi", "KhamVaDieuTri\\giayChuyenVienController@postThemNoi");//

        Route::post("xoa", "KhamVaDieuTri\\giayChuyenVienController@postXoa");//

        Route::post("xoa_noi", "KhamVaDieuTri\\giayChuyenVienController@postXoaNoi");//
        
        Route::post("xoa_all", "KhamVaDieuTri\\giayChuyenVienController@postXoaALL");//
        
        Route::post("in", "KhamVaDieuTri\\giayChuyenVienController@postIn");//
        
        Route::post("in_noi", "KhamVaDieuTri\\giayChuyenVienController@postInNoi");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\giayChuyenVienController@postTimKiem");//
        
        Route::post("lay_ds_gcv", "KhamVaDieuTri\\giayChuyenVienController@postLayDS");//
        
    });
    
    Route::group(["prefix"=>"benh_an_noi_tru", "middleware"=>"BSK_BSCC_Ad_Access"], function (){

        Route::get("", "KhamVaDieuTri\\benhAnNoiTruController@getDanhSach");//

        Route::post("lay_ds_ct", "KhamVaDieuTri\\benhAnNoiTruController@getDanhSachCT");//
        
        Route::post("them_moi", "KhamVaDieuTri\\benhAnNoiTruController@postThem");//
        
        Route::post("them_moi_ct", "KhamVaDieuTri\\benhAnNoiTruController@postThemCT");//

        Route::post("them_toa_thuoc", "KhamVaDieuTri\\benhAnNoiTruController@postThemToaThuoc");//

        Route::post("cap_nhat", "KhamVaDieuTri\\benhAnNoiTruController@postSua");// 
        
        Route::post("nhan_ba", "KhamVaDieuTri\\benhAnNoiTruController@postNhanBA");// 
        
        Route::post("cap_nhat_ct", "KhamVaDieuTri\\benhAnNoiTruController@postSuaCT");//

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\benhAnNoiTruController@postLayTTCN");//
        
        Route::post("lay_tt_cap_nhat_ct", "KhamVaDieuTri\\benhAnNoiTruController@postLayTTCNCT");//

        Route::post("xoa", "KhamVaDieuTri\\benhAnNoiTruController@postXoa");//
        
        Route::post("xoa_ct", "KhamVaDieuTri\\benhAnNoiTruController@postXoaCT");//

        Route::post("lay_ds_pdk", "KhamVaDieuTri\\benhAnNoiTruController@postLayDSPDK");//

        Route::post("loc_ds", "KhamVaDieuTri\\benhAnNoiTruController@postLocDS");//

        Route::post("lay_tt_bn", "KhamVaDieuTri\\benhAnNoiTruController@postLayTTBN");//

        Route::post("lay_ds_phong", "KhamVaDieuTri\\benhAnNoiTruController@postLayDSP");//

        Route::post("tim_kiem", "KhamVaDieuTri\\benhAnNoiTruController@postTimKiem");//
        
        Route::post("lay_ds_ba", "KhamVaDieuTri\\benhAnNoiTruController@postLayDSBA");//

        Route::post("in", "KhamVaDieuTri\\benhAnNoiTruController@postIn");//

        Route::post("kt_benh_an", "KhamVaDieuTri\\benhAnNoiTruController@postKTBA");//

        Route::post("lay_ds_pk_da_tn", "KhamVaDieuTri\\benhAnNoiTruController@postLayDSPhieuKham");//
        
        Route::post("xem_toa_thuoc", "KhamVaDieuTri\\benhAnNoiTruController@postXTT");//
        
        Route::post("xem_ket_qua_cls", "KhamVaDieuTri\\benhAnNoiTruController@postXKQCLS");//
        
        Route::post("xem_chi_dinh_tt", "KhamVaDieuTri\\benhAnNoiTruController@postXCDTT");//
        
        Route::post("xem_chi_dinh_pt", "KhamVaDieuTri\\benhAnNoiTruController@postXCDPT");//
        
    });
    
    Route::group(["prefix"=>"tra_ket_qua_cls", "middleware"=>"BSKT_Ad_Access"], function (){

        Route::get("", "KhamVaDieuTri\\KetQuaCLSController@getDanhSach");//

        Route::post("lay_ket_qua", "KhamVaDieuTri\\KetQuaCLSController@postKQ");//

        Route::post("them_moi", "KhamVaDieuTri\\KetQuaCLSController@postThem");// 

        Route::post("cap_nhat", "KhamVaDieuTri\\KetQuaCLSController@postSua");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\KetQuaCLSController@postLayTTCN");//

        Route::post("xoa", "KhamVaDieuTri\\KetQuaCLSController@postXoa");//

        Route::post("in", "KhamVaDieuTri\\KetQuaCLSController@postIn");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\KetQuaCLSController@postTimKiem");
        
        Route::post("lay_ds_kq", "KhamVaDieuTri\\KetQuaCLSController@postLayDSKQCLS");
    });

    Route::group(["prefix"=>"phieu_ke_khai_vp", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@getDanhSach");//

        Route::post("xoa", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@postXoa");//

        Route::post("kt_lap_phieu", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@postKTLapPhieuNgoai");//

        Route::post("in", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@postIn");//
        
        Route::post("in_noi", "KhamVaDieuTri\\phieuKeKhaiVPNoiTruController@postIn");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@postTimKiem");//
        
        Route::post("lay_ds_all", "KhamVaDieuTri\\phieuKeKhaiVPNgoaiTruController@postLayDS");//
    });
    
    Route::group(["prefix"=>"chi_dinh_phau_thuat", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\chiDinhPTController@getDanhSach");//

        Route::post("lay_ds", "KhamVaDieuTri\\chiDinhPTController@postLayDSCDBA");//

        Route::post("them_moi", "KhamVaDieuTri\\chiDinhPTController@postThem");// 

        Route::post("cap_nhat", "KhamVaDieuTri\\chiDinhPTController@postSua");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\chiDinhPTController@postLayTTCN");//

        Route::post("xoa", "KhamVaDieuTri\\chiDinhPTController@postXoa");//

        Route::post("kt_pt", "KhamVaDieuTri\\chiDinhPTController@postKTPT");//

        Route::post("in", "KhamVaDieuTri\\chiDinhPTController@postIn");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\chiDinhPTController@postTimKiem");//
        
        Route::post("lay_ds_all", "KhamVaDieuTri\\chiDinhPTController@postLayDS");//
    });

    Route::group(["prefix"=>"chi_dinh_thu_thuat", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\chiDinhTTController@getDanhSach");//

        Route::post("lay_ds", "KhamVaDieuTri\\chiDinhTTController@postLayDSCDBA");//

        Route::post("them_moi", "KhamVaDieuTri\\chiDinhTTController@postThem");// 

        Route::post("cap_nhat", "KhamVaDieuTri\\chiDinhTTController@postSua");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\chiDinhTTController@postLayTTCN");//

        Route::post("xoa", "KhamVaDieuTri\\chiDinhTTController@postXoa");//

        Route::post("kt_tt_ngoai_tru", "KhamVaDieuTri\\chiDinhTTController@postKTTTNgoaiTru");//

        Route::post("in", "KhamVaDieuTri\\chiDinhTTController@postIn");//
        
        
        Route::post("lay_ds_noi", "KhamVaDieuTri\\chiDinhTTController@postLayDSCDBANOI");//

        Route::post("them_moi_noi", "KhamVaDieuTri\\chiDinhTTController@postThemNoi");// 

        Route::post("cap_nhat_noi", "KhamVaDieuTri\\chiDinhTTController@postSua");// 

        Route::post("lay_tt_cap_nhat_noi", "KhamVaDieuTri\\chiDinhTTController@postLayTTCN");//

        Route::post("xoa_noi", "KhamVaDieuTri\\chiDinhTTController@postXoa");//

        Route::post("kt_tt_noi_tru", "KhamVaDieuTri\\chiDinhTTController@postKTTTNoiTru");//

        Route::post("in_noi", "KhamVaDieuTri\\chiDinhTTController@postInNoi");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\chiDinhTTController@postTimKiem");//
        
        Route::post("lay_ds_all", "KhamVaDieuTri\\chiDinhTTController@postLayDS");//
    });

    Route::group(["prefix"=>"can_lam_sang", "middleware"=>"BSK_BSCC_Ad_Access"], function (){
        
        Route::get("", "KhamVaDieuTri\\canLamSangController@getDanhSach");//

        Route::post("lay_ds", "KhamVaDieuTri\\canLamSangController@postDanhSachCDCLSNgoai");//

        Route::post("them_moi", "KhamVaDieuTri\\canLamSangController@postThem");// 

        Route::post("cap_nhat", "KhamVaDieuTri\\canLamSangController@postSua");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\canLamSangController@postLayTTCN");//

        Route::post("xoa", "KhamVaDieuTri\\canLamSangController@postXoa");//

        Route::post("kt_cls_ngoai_tru", "KhamVaDieuTri\\canLamSangController@postKTCLSNgoaiTru");//

        Route::post("in", "KhamVaDieuTri\\canLamSangController@postIn");//
        
        
        Route::post("lay_ds_noi", "KhamVaDieuTri\\canLamSangController@postDanhSachCDCLSNoi");//

        Route::post("them_moi_noi", "KhamVaDieuTri\\canLamSangController@postThemNoi");// 

        Route::post("cap_nhat_noi", "KhamVaDieuTri\\canLamSangController@postSua");// 

        Route::post("lay_tt_cap_nhat_noi", "KhamVaDieuTri\\canLamSangController@postLayTTCN");//

        Route::post("xoa_noi", "KhamVaDieuTri\\canLamSangController@postXoa");//
        
        Route::post("kt_cls_noi_tru", "KhamVaDieuTri\\canLamSangController@postKTCLSNoiTru");//

        Route::post("in_noi", "KhamVaDieuTri\\canLamSangController@postInNoi");//
        
        Route::post("tim_kiem", "KhamVaDieuTri\\canLamSangController@postTimKiem");//
        
        Route::post("lay_ds_all", "KhamVaDieuTri\\canLamSangController@postLayDS");//
        
    });

    Route::group(["prefix"=>"toa_thuoc_ngoai_tru_ct"], function (){

        Route::post("lay_ds_ck", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postDanhSachCTCK");//
        
        Route::post("lay_ds", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postDanhSachCT");//

        Route::post("cap_nhat", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postSuaCT");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postLayTTTTCT");//

        Route::post("xoa", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postXoaCT");//
        
        Route::post("kt_ct", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postKTCT");//

    });
    
    Route::group(["prefix"=>"toa_thuoc_noi_tru_ct"], function (){
        
        Route::post("lay_ds", "KhamVaDieuTri\\ToaThuocNoiTruController@postDanhSachCT");//

        Route::post("cap_nhat", "KhamVaDieuTri\\ToaThuocNoiTruController@postSuaCT");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\ToaThuocNoiTruController@postLayTTTTCT");//

        Route::post("xoa", "KhamVaDieuTri\\ToaThuocNoiTruController@postXoaCT");//

    });

    Route::group(["prefix"=>"toa_thuoc_ngoai_tru", "middleware"=>"BSK_BSCC_PT_Ad_Access"], function (){

        Route::get("", "KhamVaDieuTri\\ToaThuocNgoaiTruController@getDanhSach");//

        Route::post("them_moi", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postThem");//

        Route::post("xoa", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postXoa");//

        Route::post("tim_kiem", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postTimKiem");//
        
        Route::post("tim_kiem_nvpt", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postTimKiemNVPT");//

        Route::post("in", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postIn");//
        
        Route::post("lay_ds_toa", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postLayDS");//
        
        Route::post("lay_ds_toa_nvpt", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postLayDSNVPT");//
        
        Route::post("xac_nhan_lt", "KhamVaDieuTri\\ToaThuocNgoaiTruController@postXNLT");//
    });
    
    Route::group(["prefix"=>"toa_thuoc_noi_tru", "middleware"=>"BSK_BSCC_PT_Ad_Access"], function (){

        Route::get("", "KhamVaDieuTri\\ToaThuocNoiTruController@getDanhSach");//

        Route::post("them_moi", "KhamVaDieuTri\\ToaThuocNoiTruController@postThem");//

        Route::post("xoa", "KhamVaDieuTri\\ToaThuocNoiTruController@postXoa");//

        Route::post("tim_kiem", "KhamVaDieuTri\\ToaThuocNoiTruController@postTimKiem");//
        
        Route::post("tim_kiem_nvpt", "KhamVaDieuTri\\ToaThuocNoiTruController@postTimKiemNVPT");//

        Route::post("in", "KhamVaDieuTri\\ToaThuocNoiTruController@postIn");//
        
        Route::post("lay_ds_toa", "KhamVaDieuTri\\ToaThuocNoiTruController@postLayDS");//
        
        Route::post("lay_ds_toa_nvpt", "KhamVaDieuTri\\ToaThuocNoiTruController@postLayDSNVPT");//
        
        Route::post("xac_nhan_lt", "KhamVaDieuTri\\ToaThuocNoiTruController@postXNLT");//
    });

    Route::group(["prefix"=>"benh_an_ngoai_tru", "middleware"=>"BSK_Ad_Access"], function (){

        Route::get("", "KhamVaDieuTri\\benhAnNgoaiTruController@getDanhSach");//

        Route::post("them_moi", "KhamVaDieuTri\\benhAnNgoaiTruController@postThem");//

        Route::post("them_toa_thuoc", "KhamVaDieuTri\\benhAnNgoaiTruController@postThemToaThuoc");//

        Route::post("cap_nhat", "KhamVaDieuTri\\benhAnNgoaiTruController@postSua");// 

        Route::post("lay_tt_cap_nhat", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayTTCN");//

        Route::post("xoa", "KhamVaDieuTri\\benhAnNgoaiTruController@postXoa");//

        Route::post("lay_ds_pdk", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayDSPDK");//

        Route::post("loc_ds", "KhamVaDieuTri\\benhAnNgoaiTruController@postLocDS");//

        Route::post("lay_tt_bn", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayTTBN");//

        Route::post("lay_ds_phong", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayDSP");//

        Route::post("tim_kiem", "KhamVaDieuTri\\benhAnNgoaiTruController@postTimKiem");//

        Route::post("in", "KhamVaDieuTri\\benhAnNgoaiTruController@postIn");//

        Route::post("kt_benh_an", "KhamVaDieuTri\\benhAnNgoaiTruController@postKTBA");//

        Route::post("lay_ds_pk_da_tn", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayDSPhieuKham");//
        
        Route::post("lay_ds_ba", "KhamVaDieuTri\\benhAnNgoaiTruController@postLayDSBA");
    });
});

Route::group(["prefix"=>"tiep_don", "middleware"=>"UserTDLogin"], function (){
    
    Route::get("", "TiepDon\\HomeController@getIndex");
    
    Route::group(["prefix"=>"duyet_van_ban"], function (){

        Route::get("", "HanhChinh\\DVBController@getDanhSachTD");//

        Route::post("duyet", "HanhChinh\\DVBController@postThem");
        
        Route::post("xem_ct", "HanhChinh\\DVBController@postSua");
        
        Route::post("xoa", "HanhChinh\\DVBController@postXoa");
        
        Route::post("tim_kiem", "HanhChinh\\DVBController@postTimKiem");
        
        Route::post("lay_ds", "HanhChinh\\DVBController@postLayDS");
    });

    Route::group(["prefix"=>"thong_ke"], function (){
        
        Route::get("", "TiepDon\\thongkeController@getDanhSach");//
        
        Route::post("them_tk", "TiepDon\\thongkeController@postLocDS");//
        
    });
    
    Route::group(["prefix"=>"cap_cuu", "middleware"=>"TCCCAccess"], function (){
        
        Route::get("", "TiepDon\\dangKyKhamController@getDanhSachCC");//
        
    });
    
    Route::group(["prefix"=>"lich_su_dang_ky_kham"], function (){
        
        Route::get("", "TiepDon\\dangKyKhamController@getDanhSachLS");//
        
    });
    
    Route::group(["prefix"=>"dang_ky_kham", "middleware"=>"TDKBAccess"], function (){
        
        Route::get("", "TiepDon\\dangKyKhamController@getDanhSach");//
        
        Route::post("them_moi", "TiepDon\\dangKyKhamController@postThem");//
        
        Route::post("cap_nhat", "TiepDon\\dangKyKhamController@postSua");// 
        
        Route::post("lay_tt_cap_nhat", "TiepDon\\dangKyKhamController@postLayTTCN");//
        
        Route::post("xoa", "TiepDon\\dangKyKhamController@postXoa");//
        
        Route::post("lay_ds_pdk", "TiepDon\\dangKyKhamController@postLayDSPDK");//

        Route::post("loc_ds", "TiepDon\\dangKyKhamController@postLocDS");//
        
        Route::post("lay_tt_bn", "TiepDon\\dangKyKhamController@postLayTTBN");//
        
        Route::post("lay_ds_phong", "TiepDon\\dangKyKhamController@postLayDSP");//
        
        Route::post("tim_kiem", "TiepDon\\dangKyKhamController@postTimKiem");//
        
        Route::post("in", "TiepDon\\dangKyKhamController@postIn");//
    });
    
    Route::group(["prefix"=>"thong_tin_the_bhyt"], function (){
        
        Route::get("", "TiepDon\\theBHYTController@getDanhSach");
        
        Route::post("them_moi", "TiepDon\\theBHYTController@postThem");
        
        Route::post("cap_nhat", "TiepDon\\theBHYTController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "TiepDon\\theBHYTController@postLayTTCN");
        
        Route::post("xoa", "TiepDon\\theBHYTController@postXoa");
        
        Route::post("lay_ds_the_bhyt", "TiepDon\\theBHYTController@postLayDSTBHYT");

        Route::post("loc_ds", "TiepDon\\theBHYTController@postLocDS");
    });
    
    Route::group(["prefix"=>"thong_tin_benh_nhan"], function (){
        
        Route::get("", "TiepDon\\benhNhanController@getDanhSach");
        
        Route::post("them_moi", "TiepDon\\benhNhanController@postThem");
        
        Route::post("cap_nhat", "TiepDon\\benhNhanController@postSua"); 
        
        Route::post("lay_tt_cap_nhat", "TiepDon\\benhNhanController@postLayTTCN");
        
        Route::post("xoa", "TiepDon\\benhNhanController@postXoa");
        
        Route::post("lay_ds_huyen", "TiepDon\\benhNhanController@postHuyen");
        
        Route::post("lay_ds_xa", "TiepDon\\benhNhanController@postXa");
        
        Route::post("tim_kiem", "TiepDon\\benhNhanController@postTimKiem");
        
        Route::post("lay_ds_bn", "TiepDon\\benhNhanController@postLayDSBN");
        
        Route::post("loc_ds", "TiepDon\\benhNhanController@postLocDS");
    });
});
