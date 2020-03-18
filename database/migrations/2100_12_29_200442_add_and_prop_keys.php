<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddAndPropKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Thêm các khoá chính đối với các bảng có từ 2 khoá chính trở lên*/

        DB::statement("ALTER TABLE `hoc_ky__chuong_trinh_dao_tao` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKDT`, `idCTDT`);");

        DB::statement("ALTER TABLE `hoc_ky_hoc_tap_sinh_vien` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKSV`, `idUser`);");

        DB::statement("ALTER TABLE `phieu_dang_ky_hoc_phan` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHP`, `idUser`, `idHKSV`, `idGV`, `idLop`);");

        DB::statement("ALTER TABLE `phieu_danh_gia_diem_ren_luyen` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKSV`, `idUser`, `idTCDG`);");

        DB::statement("ALTER TABLE `phieu_phan_cong_giang_day` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHP`, `idUser`);");

        DB::statement("ALTER TABLE `phieu_danh_gia_giang_day` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHP`, `idUser`, `idHKSV`, `idTCDGGD`);");

        DB::statement("ALTER TABLE `lop__nguoi_dung` DROP PRIMARY KEY, ADD PRIMARY KEY (`idUser`, `idLop`);");

        DB::statement("ALTER TABLE `hoc_phan__hoc_ky` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKDT`, `idCTDT`, `idHP`);");
        
        DB::statement("ALTER TABLE `phieu_danh_gia_drlct` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKSV`, `idUser`, `idTCDG`, `idTCDGCT`);");

        DB::statement("ALTER TABLE `phieu_danh_gia_drlctcct` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKSV`, `idUser`, `idTCDG`, `idTCDGCT`, `idTCDGCTCCT`);");

        DB::statement("ALTER TABLE `thong_bao__bieu_mau_dang_file` DROP PRIMARY KEY, ADD PRIMARY KEY (`idTB`, `idBM`);");

        DB::statement("ALTER TABLE `thong_bao__bieu_mau_dang_xml` DROP PRIMARY KEY, ADD PRIMARY KEY (`idTB`, `idBM`);");

        DB::statement("ALTER TABLE `thong_bao__van_ban` DROP PRIMARY KEY, ADD PRIMARY KEY (`idTB`, `idVB`);");

        DB::statement("ALTER TABLE `phieu_danh_gia_truong` DROP PRIMARY KEY, ADD PRIMARY KEY (`idHKSV`, `idUser`, `idTCDGT`);");

        DB::statement("ALTER TABLE `ql_dang_ky_hoc_phan` DROP PRIMARY KEY, ADD PRIMARY KEY (`namHoc`, `hocKy`, `khoaDaoTao`);");
        
        DB::statement("ALTER TABLE `thong_bao__khoa` DROP PRIMARY KEY, ADD PRIMARY KEY (`idTB`, `idKhoa`);");

        DB::statement("ALTER TABLE `thong_bao__lop` DROP PRIMARY KEY, ADD PRIMARY KEY (`idTB`, `idLop`);");

        /*Thêm các khoá ngoại*/
        Schema::table("lop", function(Blueprint $table){
            $table->foreign("idCTDT", "fk_lop__CTDT__idCTDT")->references("idCTDT")->on("chuong_trinh_dao_tao")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('thong_bao', function(Blueprint $table){
            $table->foreign("idUser", "fk_thong_bao__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("bieu_mau_dang_file", function(Blueprint $table){
            $table->foreign("idUser", "fk_BMDF__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("bieu_mau_dang_xml", function(Blueprint $table){
            $table->foreign("idUser", "fk_BMDXML__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("van_ban", function(Blueprint $table){
            $table->foreign("idUser", "fk_van_ban__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("users", function(Blueprint $table){
            $table->foreign("idQuyen", "fk_users__QH__idQuyen")->references("idQuyen")->on("quyen_han_user")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("tin_nhan", function(Blueprint $table){
            $table->foreign("idUserGui", "fk_tin_nhan__users__idUserGui")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUserNhan", "fk_tin_nhan__users__idUserNhan")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("hoc_ky__chuong_trinh_dao_tao", function(Blueprint $table){
            $table->foreign("idCTDT", "fk_HK__CTDT__CTDT__idCTDT")->references("idCTDT")->on("chuong_trinh_dao_tao")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phong_ban', function(Blueprint $table){
            $table->foreign("idKhoa", "fk_phong_ban__khoa__idKhoa")->references("idKhoa")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('can_bo_giang_vien', function(Blueprint $table){
            $table->foreign("idXa", "fk_CBGV__XPTT__idXa")->references("idXa")->on("xa__phuong__thi_tran")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idPhong", "fk_CBGV__phong_ban__idPhong")->references("idPhong")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('sinh_vien', function(Blueprint $table){
            $table->foreign("idXa", "fk_SV__XPTT__idXa")->references("idXa")->on("xa__phuong__thi_tran")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('chuong_trinh_dao_tao', function(Blueprint $table){
            $table->foreign("idPhong", "fk_CTDT__phong_ban__idPhong")->references("idPhong")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('xa__phuong__thi_tran', function(Blueprint $table){
            $table->foreign("idHuyen", "fk_XPTT__QH__idHuyen")->references("idHuyen")->on("quan__huyen")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('quan__huyen', function(Blueprint $table){
            $table->foreign("idTinh", "fk_QH__TTP__idTinh")->references("idTinh")->on("tinh__thanh_pho")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('hoc_ky_hoc_tap_sinh_vien', function(Blueprint $table){
            $table->foreign("idUser", "fk_HKHTSV__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('tcdgdrl_sinh_vien_chi_tiet', function(Blueprint $table){
            $table->foreign("idTCDG", "fk_TCDGDRLSVCT__TCDGDRL__idTCDG")->references("idTCDG")->on("tieu_chi_danh_gia_diem_ren_luyen")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('tcdgdrl_sinh_vien_ctcct', function(Blueprint $table){
            $table->foreign("idTCDGCT", "fk_TCDGDRLSVCTCCT__TCDGDRLSVCT__idTCDGCT")->references("idTCDGCT")->on("tcdgdrl_sinh_vien_chi_tiet")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_dang_ky_hoc_phan', function(Blueprint $table){
            $table->foreign(["idHP", "idUser"], "fk_PDKHP__PPCGD__idHP_idUser")->references(["idHP", "idUser"])->on("phieu_phan_cong_giang_day")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idLop", "fk_PDKHP__lop__idLop")->references("idLop")->on("lop")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign(["idHKSV", "idUser"], "fk_PDKHP__HKHTSV__idUser_idHKSV")->references(["idHKSV", "idUser"])->on("hoc_ky_hoc_tap_sinh_vien")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_danh_gia_diem_ren_luyen', function(Blueprint $table){
            $table->foreign("idTCDG", "fk_PDGDRL__TCDGDRL__idTCDG")->references("idTCDG")->on("tieu_chi_danh_gia_diem_ren_luyen")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign(["idHKSV", "idUser"], "fk_PDGDRL__HKHTSV__idUser_idHKSV")->references(["idHKSV", "idUser"])->on("hoc_ky_hoc_tap_sinh_vien")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_phan_cong_giang_day', function(Blueprint $table){
            $table->foreign("idHP", "fk_PPCGD__hoc_phan__idHP")->references("idHP")->on("hoc_phan")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk_PPCGD__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_danh_gia_giang_day', function(Blueprint $table){
            $table->foreign(["idHP", "idHKSV", "idUser"], "fk_PDGGD__PDKHP__idHP_idHKSV_idUser")->references(["idHP", "idUser", "idHKSV"])->on("phieu_dang_ky_hoc_phan")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idTCDGGD", "fk_PDGGD__TCDGGD__idTCDGGD")->references("idTCDGGD")->on("tieu_chi_danh_gia_giang_day")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('lop__nguoi_dung', function(Blueprint $table){
            $table->foreign("idLop", "fk_ND__L__lop__idLop")->references("idLop")->on("lop")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk_ND__L__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('hoc_phan__hoc_ky', function(Blueprint $table){
            $table->foreign("idHP", "fk_HP__HK__HP__idHP")->references("idHP")->on("hoc_phan")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign(["idHKDT", "idCTDT"], "fk_HP__HK__HK__CTDT__idHKDT_idCTDT")->references(["idHKDT", "idCTDT"])->on("hoc_ky__chuong_trinh_dao_tao")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("bieu_mau_dang_xml__nguoi_dung", function(Blueprint $table){
            $table->foreign("idBM", "fk_BMDXML_users__BMDXML__idBM")->references("idBM")->on("bieu_mau_dang_xml")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk_BMDXML_users__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("sinh_vien__nguoi_dung", function(Blueprint $table){
            $table->foreign("idUser", "fk_SV__ND__users__idSV")->references("idSV")->on("sinh_vien")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk_SV__ND__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("can_bo_giang_vien__nguoi_dung", function(Blueprint $table){
            $table->foreign("idUser", "fk_CBGV__ND__users__idCB")->references("idCB")->on("can_bo_giang_vien")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk_CBGV__ND__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('bang_diem_duoi_1_tiet', function(Blueprint $table){
            $table->foreign(["idHP", "idUser", "idHKSV"], "fk_BDD1T__HKHTSV__idHP_idUser_idHKSV")->references(["idHP", "idUser", "idHKSV"])->on("phieu_dang_ky_hoc_phan")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('bang_diem_tu_1_tiet_tro_len', function(Blueprint $table){
            $table->foreign(["idHP", "idUser", "idHKSV"], "fk_BDT1T__HKHTSV__idHP_idUser_idHKSV")->references(["idHP", "idUser", "idHKSV"])->on("phieu_dang_ky_hoc_phan")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('bang_diem_thi', function(Blueprint $table){
            $table->foreign(["idHP", "idUser", "idHKSV"], "fk_BDT__HKHTSV__idHP_idUser_idHKSV")->references(["idHP", "idUser", "idHKSV"])->on("phieu_dang_ky_hoc_phan")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_danh_gia_drlct', function(Blueprint $table){
            $table->foreign(["idTCDG", "idUser", "idHKSV"], "fk_PDGDRLCT__PDGDRL__idTCDG_idUser_idHKSV")->references(["idHKSV", "idUser", "idTCDG"])->on("phieu_danh_gia_diem_ren_luyen")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idTCDGCT", "fk_PDGDRLCT__TCDGDRLSVCT__idTCDGCT")->references("idTCDGCT")->on("tcdgdrl_sinh_vien_chi_tiet")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_danh_gia_drlctcct', function(Blueprint $table){
            $table->foreign(["idHKSV", "idUser", "idTCDG", "idTCDGCT"], "fk_CTCPDGDRLCT__PDGDRLCT__idTCDG_idUser_idHKSV_idTCDGCT")->references(["idTCDG", "idUser", "idHKSV", "idTCDGCT"])->on("phieu_danh_gia_drlct")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idTCDGCTCCT", "fk_CTCPDGDRLCT__TCDGDRLSVCTCCT__idTCDGCTCCT")->references("idTCDGCTCCT")->on("tcdgdrl_sinh_vien_ctcct")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("phieu_phan_cong_co_van_hoc_tap", function(Blueprint $table){
            $table->foreign("idLop", "fk__PPCCVHT__lop__idLop")->references("idLop")->on("lop")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idUser", "fk__PPCCVHT__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("thong_bao__bieu_mau_dang_file", function(Blueprint $table){
            $table->foreign("idTB", "fk__TB__BMDF__TB__idTB")->references("idTB")->on("thong_bao")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idBM", "fk__TB__BMDF__TB__idBM")->references("idBM")->on("bieu_mau_dang_file")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("thong_bao__bieu_mau_dang_xml", function(Blueprint $table){
            $table->foreign("idTB", "fk__TB__BMDXML__TB__idTB")->references("idTB")->on("thong_bao")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idBM", "fk__TB__BMDXML__TB__idBM")->references("idBM")->on("bieu_mau_dang_xml")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("thong_bao__van_ban", function(Blueprint $table){
            $table->foreign("idTB", "fk__TB__VB__idTB")->references("idTB")->on("thong_bao")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idVB", "fk__TB__VB__idVB")->references("idVB")->on("van_ban")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("file_cua_tin_nhan", function(Blueprint $table){
            $table->foreign("idTN", "fk__FCTN__TN__idTN")->references("idTN")->on("tin_nhan")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_danh_gia_truong', function(Blueprint $table){
            $table->foreign("idTCDGT", "fk_PDGDT__TCDGDT__idTCDGT")->references("idTCDGT")->on("tieu_chi_danh_gia_truong")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign(["idHKSV", "idUser"], "fk_PDGDT__HKHTSV__idUser__idHKSV_idUser")->references(["idHKSV", "idUser"])->on("hoc_ky_hoc_tap_sinh_vien")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("hoc_ky_giang_day", function(Blueprint $table){
            $table->foreign("idUser", "fk_HKGD__users__idUser")->references("idUser")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("thong_bao__khoa", function(Blueprint $table){
            $table->foreign("idTB", "fk__TB__khoa__idTB")->references("idTB")->on("thong_bao")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idKhoa", "fk__TB__khoa__idKhoa")->references("idKhoa")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table("thong_bao__lop", function(Blueprint $table){
            $table->foreign("idTB", "fk__TB__lop__idTB")->references("idTB")->on("thong_bao")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("idLop", "fk__TB__lop__idLop")->references("idLop")->on("lop")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("lop", function(Blueprint $table){
            $table->dropForeign("fk_lop__CTDT__idCTDT");
        });

        Schema::table('thong_bao', function(Blueprint $table){
            $table->dropForeign("fk_thong_bao__users__idUser");
        });

        Schema::table("bieu_mau_dang_file", function(Blueprint $table){
            $table->dropForeign("fk_BMDF__users__idUser");
        });

        Schema::table("bieu_mau_dang_xml", function(Blueprint $table){
            $table->dropForeign("fk_BMDXML__users__idUser");
        });

        Schema::table("van_ban", function(Blueprint $table){
            $table->dropForeign("fk_van_ban__users__idUser");
        });

        Schema::table("users", function(Blueprint $table){
            $table->dropForeign("fk_users__XPTT__idXa");
            $table->dropForeign("fk_users__QH__idQuyen");
        });

        Schema::table("tin_nhan", function(Blueprint $table){
            $table->dropForeign("fk_tin_nhan__users__idUserGui");
            $table->dropForeign("fk_tin_nhan__users__idUserNhan");
        });

        Schema::table("hoc_ky__chuong_trinh_dao_tao", function(Blueprint $table){
            $table->dropForeign("fk_HK__CTDT__CTDT__idCTDT");
        });

        Schema::table('phong_ban', function(Blueprint $table){
            $table->dropForeign("fk_phong_ban__khoa__idKhoa");
        });

        Schema::table('can_bo_giang_vien', function(Blueprint $table){
            $table->dropForeign("fk_CBGV__XPTT__idXa");
            $table->dropForeign("fk_CBGV__phong_ban__idPhong");
        });

        Schema::table('sinh_vien', function(Blueprint $table){
            $table->dropForeign("fk_SV__XPTT__idXa");
        });
        
        Schema::table('chuong_trinh_dao_tao', function(Blueprint $table){
            $table->dropForeign("fk_CTDT__phong_ban__idPhong");
        });

        Schema::table('xa__phuong__thi_tran', function(Blueprint $table){
            $table->dropForeign("fk_XPTT__QH__idHuyen");
        });

        Schema::table('quan__huyen', function(Blueprint $table){
            $table->dropForeign("fk_QH__TTP__idTinh");
        });

        Schema::table('hoc_ky_hoc_tap_sinh_vien', function(Blueprint $table){
            $table->dropForeign("fk_HKHTSV__users__idUser");
        });

        Schema::table('tcdgdrl_sinh_vien_chi_tiet', function(Blueprint $table){
            $table->dropForeign("fk_TCDGDRLSVCT__TCDGDRL__idTCDG");
        });

        Schema::table('tcdgdrl_sinh_vien_ctcct', function(Blueprint $table){
            $table->dropForeign("fk_TCDGDRLSVCTCCT__TCDGDRLSVCT__idTCDGCT");
        });

        Schema::table('phieu_dang_ky_hoc_phan', function(Blueprint $table){
            $table->dropForeign("fk_PDKHP__PPCGD__idHP_idUser");
            $table->dropForeign("fk_PDKHP__lop__idLop");
            $table->dropForeign("fk_PDKHP__HKHTSV__idUser_idHKSV");
        });

        Schema::table('phieu_danh_gia_diem_ren_luyen', function(Blueprint $table){
            $table->dropForeign("fk_PDGDRL__TCDGDRL__idTCDG");
            $table->dropForeign("fk_PDGDRL__HKHTSV__idUser_idHKSV");
        });

        Schema::table('phieu_phan_cong_giang_day', function(Blueprint $table){
            $table->dropForeign("fk_PPCGD__hoc_phan__idHP");
            $table->dropForeign("fk_PPCGD__users__idUser");
        });

        Schema::table('phieu_danh_gia_giang_day', function(Blueprint $table){
            $table->dropForeign("fk_PDGGD__PDKHP__idHP_idHKSV_idUser");
            $table->dropForeign("fk_PDGGD__TCDGGD__idTCDGGD");
        });

        Schema::table('lop__nguoi_dung', function(Blueprint $table){
            $table->dropForeign("fk_ND__L__lop__idLop");
            $table->dropForeign("fk_ND__L__users__idUser");
        });

        Schema::table('hoc_phan__hoc_ky', function(Blueprint $table){
            $table->dropForeign("fk_HP__HK__HP__idHP");
            $table->dropForeign("fk_HP__HK__HK__CTDT__idHKDT_idCTDT");
        });

        Schema::table("bieu_mau_dang_xml__nguoi_dung", function(Blueprint $table){
            $table->dropForeign("fk_BMDXML_users__BMDXML__idBM");
            $table->dropForeign("fk_BMDXML_users__users__idUser");
        });

        Schema::table("sinh_vien__nguoi_dung", function(Blueprint $table){
            $table->dropForeign("fk_SV__ND__users__idUser");
            $table->dropForeign("fk_SV__ND__users__idSV");
        });

        Schema::table("can_bo_giang_vien__nguoi_dung", function(Blueprint $table){
            $table->dropForeign("fk_CBGV__ND__users__idUser");
            $table->dropForeign("fk_CBGV__ND__users__idCB");
        });

        Schema::table('bang_diem_duoi_1_tiet', function(Blueprint $table){
            $table->dropForeign("fk_BDD1T__HKHTSV__idHP_idUser_idHKSV");
        });

        Schema::table('bang_diem_tu_1_tiet_tro_len', function(Blueprint $table){
            $table->dropForeign("fk_BDT1T__HKHTSV__idHP_idUser_idHKSV");
        });

        Schema::table('bang_diem_thi', function(Blueprint $table){
            $table->dropForeign("fk_BDT__HKHTSV__idHP_idUser_idHKSV");
        });

        Schema::table('phieu_danh_gia_drlct', function(Blueprint $table){
            $table->dropForeign("fk_PDGDRLCT__PDGDRL__idTCDG_idUser_idHKSV");
            $table->dropForeign("fk_PDGDRLCT__TCDGDRLSVCT__idTCDGCT");
        });

        Schema::table('phieu_danh_gia_drlctcct', function(Blueprint $table){
            $table->dropForeign("fk_CTCPDGDRLCT__PDGDRLCT__idTCDG_idUser_idHKSV_idTCDGCT");
            $table->dropForeign("idTCDGCTCCT", "fk_CTCPDGDRLCT__TCDGDRLSVCTCCT__idTCDGCTCCT");
        });

        Schema::table("phieu_phan_cong_co_van_hoc_tap", function(Blueprint $table){
            $table->dropForeign("fk__PPCCVHT__lop__idLop");
            $table->dropForeign("fk__PPCCVHT__users__idUser");
        });

        Schema::table("thong_bao__bieu_mau_dang_file", function(Blueprint $table){
            $table->dropForeign("fk__TB__BMDF__TB__idTB");
            $table->dropForeign("fk__TB__BMDF__TB__idBM");
        });

        Schema::table("thong_bao__bieu_mau_dang_xml", function(Blueprint $table){
            $table->dropForeign("fk__TB__BMDXML__TB__idTB");
            $table->dropForeign("fk__TB__BMDXML__TB__idBM");
        });

        Schema::table("thong_bao__van_ban", function(Blueprint $table){
            $table->dropForeign("fk__TB__VB__idTB");
            $table->dropForeign("fk__TB__VB__idVB");
        });

        Schema::table("file_cua_tin_nhan", function(Blueprint $table){
            $table->dropForeign("fk__FCTN__TN__idTN");
        });

        Schema::table('phieu_danh_gia_truong', function(Blueprint $table){
            $table->dropForeign("fk_PDGDT__TCDGDT__idTCDGT");
            $table->dropForeign("fk_PDGDT__HKHTSV__idUser__idHKSV_idUser");
        });

        Schema::table("hoc_ky_giang_day", function(Blueprint $table){
            $table->dropForeign("fk_HKGD__users__idUser");
        });

        Schema::table("thong_bao__khoa", function(Blueprint $table){
            $table->dropForeign("fk__TB__khoa__idTB");
            $table->dropForeign("fk__TB__khoa__idKhoa");
        });

        Schema::table("thong_bao__lop", function(Blueprint $table){
            $table->dropForeign("fk__TB__lop__idTB");
            $table->dropForeign("fk__TB__lop__idLop");
        });
    }
}
