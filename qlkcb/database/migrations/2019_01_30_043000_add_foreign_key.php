<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Add primary keys
        DB::statement("ALTER TABLE `phieu_dk_kham_vs_benh_an_ngoai_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPhieuDKKB`,`IdBANgoaiT`);");
        
        DB::statement("ALTER TABLE `phieu_dk_kham_vs_benh_an_noi_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPhieuDKKB`,`IdBANoiT`);");
        
        DB::statement("ALTER TABLE `benh_an_ngoai_tru_vs_can_lam_sang` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdCLS`,`IdBANgoaiT`);");
        
        DB::statement("ALTER TABLE `benh_an_noi_tru_ct_vs_can_lam_sang` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBACT`,`IdCLS`);");
        
        DB::statement("ALTER TABLE `benh_an_noi_tru_ct_vs_can_lam_sang` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBACT`,`IdCLS`);");
        
        DB::statement("ALTER TABLE `chuan_doan_vs_benh_an_ngoai_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBANgoaiT`,`IdBenh`);");
        
        DB::statement("ALTER TABLE `chuan_doan_vs_benh_an_noi_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBANoiT`,`IdBenh`);");
       
        DB::statement("ALTER TABLE `chuan_doan_vs_ket_qua_cls` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdKQCLS`,`IdBenh`);");
        
        DB::statement("ALTER TABLE `phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPKKCT`,`IdDMCLS`);");
        
        DB::statement("ALTER TABLE `phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPKKCT`,`IdThuoc`);");
        
        DB::statement("ALTER TABLE `phieu_ke_khai_vpct_noi_vs_danh_muc_cls` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPKKCT`,`IdDMCLS`);");
        
        DB::statement("ALTER TABLE `phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdPKKCT`,`IdThuoc`);");
        
        DB::statement("ALTER TABLE `toa_thuoc_ct` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdTT`, `IdThuoc`);");
        
        DB::statement("ALTER TABLE `toa_thuoc_vs_benh_an_ngoai_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdTT`, `IdBANgoaiT`);");
        
        DB::statement("ALTER TABLE `toa_thuoc_vs_benh_an_noi_tru_ct` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdTT`, `IdBACT`);");
        
        DB::statement("ALTER TABLE `danh_muc_benh_vs_khoa` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdKhoa`,`IdBenh`);");
        
        DB::statement("ALTER TABLE `danh_muc_cls_vs_khoa` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdKhoa`,`IdDMCLS`);");
        
        DB::statement("ALTER TABLE `chi_dinh_tt_vs_benh_an_ngoai_tru` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdThuThuat`,`IdBANgoaiT`);");
        
        DB::statement("ALTER TABLE `chi_dinh_tt_vs_benh_an_noi_tru_ct` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdThuThuat`,`IdBACT`);");
        
        DB::statement("ALTER TABLE `chuc_vu_vs_nv` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdCV`,`IdNV`);");
        
        DB::statement("ALTER TABLE `danh_muc_benh_vs_thuoc` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBenh`,`IdThuoc`);");
        
        DB::statement("ALTER TABLE `ba_nv` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdBANoiT`,`IdNV`);");
        
        DB::statement("ALTER TABLE `duyet_tk` DROP PRIMARY KEY , ADD PRIMARY KEY (`IdTK`,`IdNV`);");

        //---------------------
        Schema::table('benh_nhan', function(Blueprint $table) {
            $table->foreign("IdXa", "fk_benh_nhan_IdXa")->references("IdXa")->on("phuong_xa")->onUpdate("cascade")->onDelete("cascade");
            
        });

        Schema::table('thong_ke', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_thong_ke_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('file_tk', function(Blueprint $table) {
            $table->foreign("IdTK", "fk_file_tk_IdTK")->references("IdTK")->on("thong_ke")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('nhan_vien', function(Blueprint $table) {
            $table->foreign("IdXa", "fk_nhan_vien_IdXa")->references("IdXa")->on("phuong_xa")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdPB", "fk_nhan_vien_IdPB")->references("IdPB")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('duyet_tk', function(Blueprint $table) {
            $table->foreign("IdTK", "fk_duyet_tk_IdCV")->references("IdTK")->on("thong_ke")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNV", "fk_duyet_tk_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('chuc_vu_vs_nv', function(Blueprint $table) {
            $table->foreign("IdCV", "fk_chuc_vu_vs_nv_IdCV")->references("IdCV")->on("chuc_vu")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNV", "fk_chuc_vu_vs_nv_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_dk_kham', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_phieu_dk_kham_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBN", "fk_phieu_dk_kham_IdBN")->references("IdBN")->on("benh_nhan")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdPK", "fk_phieu_dk_kham_IdPK")->references("IdPB")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_dk_kham_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdPhieuDKKB", "fk_phieu_dk_kham_vs_benh_an_ngoai_tru_IdPhieuDKKB")->references("IdPhieuDKKB")->on("phieu_dk_kham")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBANgoaiT", "fk_phieu_dk_kham_vs_benh_an_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_dk_kham_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->foreign("IdPhieuDKKB", "fk_phieu_dk_kham_vs_benh_an_noi_tru_IdPhieuDKKB")->references("IdPhieuDKKB")->on("phieu_dk_kham")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBANoiT", "fk_phieu_dk_kham_vs_benh_an_noi_tru_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('ba_nv', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_ba_nv_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNV", "fk_ba_nv_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phong_ban', function(Blueprint $table) {
            $table->foreign("IdKhoa", "fk_phong_ban_IdKhoa")->references("IdKhoa")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phuong_xa', function(Blueprint $table) {
            $table->foreign("IdHuyen", "fk_phuong_xa_IdHuyen")->references("IdHuyen")->on("quan_huyen")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('quan_huyen', function(Blueprint $table) {
            $table->foreign("IdTinh", "fk_quan_huyen_IdTinh")->references("IdTinh")->on("tinh_tp")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('the_bhyt', function(Blueprint $table) {
            $table->foreign("IdCSKBHYT", "fk_the_bhyt_IdCSKBHYT")->references("IdCSKBHYT")->on("co_so_kham_bhyt")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBN", "fk_the_bhyt_IdBN")->references("IdBN")->on("benh_nhan")->onUpdate("cascade")->onDelete("cascade");
        });
        
        //-------------------------------
        
        Schema::table('benh_an_noi_tru', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_benh_an_noi_tru_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
            
            $table->foreign("IdGiuong", "fk_benh_an_noi_tru_IdGiuong")->references("IdTB")->on("thiet_bi_yt")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('benh_an_ngoai_tru_vs_can_lam_sang', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_benh_an_ngoai_tru_vs_can_lam_sang_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdCLS", "fk_benh_an_ngoai_tru_vs_can_lam_sang_IdCLS")->references("IdCLS")->on("can_lam_sang")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('benh_an_noi_tru_ct_vs_can_lam_sang', function(Blueprint $table) {
            $table->foreign("IdBACT", "fk_benh_an_noi_tru_ct_vs_can_lam_sang_IdBACT")->references("IdBACT")->on("benh_an_noi_tru_ct")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdCLS", "fk_benh_an_noi_tru_ct_vs_can_lam_sang_IdCLS")->references("IdCLS")->on("can_lam_sang")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_benh_an_noi_tru_ct_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('can_lam_sang', function(Blueprint $table) {
            $table->foreign("IdPB", "fk_can_lam_sang_IdPB")->references("IdPB")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdDMCLS", "fk_can_lam_sang_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chuan_doan_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_chuan_doan_vs_benh_an_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBenh", "fk_chuan_doan_vs_benh_an_ngoai_tru_IdBenh")->references("IdBenh")->on("danh_muc_benh")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chuan_doan_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_chuan_doan_vs_benh_an_noi_tru_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdBenh", "fk_chuan_doan_vs_benh_an_noi_tru_IdBenh")->references("IdBenh")->on("danh_muc_benh")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chuan_doan_vs_ket_qua_cls', function(Blueprint $table) {
            $table->foreign("IdBenh", "fk_chuan_doan_vs_ket_qua_cls_IdBenh")->references("IdBenh")->on("danh_muc_benh")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdKQCLS", "fk_chuan_doan_vs_ket_qua_cls_IdKQCLS")->references("IdKQCLS")->on("ket_qua_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        Schema::table('giay_ra_vien', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_giay_ra_vien_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('thiet_bi_yt', function(Blueprint $table) {
            $table->foreign("IdPB", "fk_thiet_bi_yt_IdPB")->references("IdPB")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('ket_qua_cls', function(Blueprint $table) {
            $table->foreign("IdCLS", "fk_ket_qua_cls_IdCLS")->references("IdCLS")->on("can_lam_sang")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNVTH", "fk_ket_qua_cls_IdNVTH")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vp_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_phieu_ke_khai_vp_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('phieu_ke_khai_vp_noi_tru', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_phieu_ke_khai_vp_noi_tru_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdPKK", "fk_phieu_ke_khai_vpct_ngoai_tru_IdPKK")->references("IdPKK")->on("phieu_ke_khai_vp_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls', function(Blueprint $table) {
            $table->foreign("IdPKKCT", "fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls_IdPKKCT")->references("IdPKKCT")->on("phieu_ke_khai_vpct_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdDMCLS", "fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc', function(Blueprint $table) {
            $table->foreign("IdPKKCT", "fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc_IdPKKCT")->references("IdPKKCT")->on("phieu_ke_khai_vpct_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuoc", "fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc_IdThuoc")->references("IdThuoc")->on("danh_muc_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_tru', function(Blueprint $table) {
            $table->foreign("IdPKK", "fk_phieu_ke_khai_vpct_noi_tru_IdPKK")->references("IdPKK")->on("phieu_ke_khai_vp_noi_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_vs_danh_muc_cls', function(Blueprint $table) {
            $table->foreign("IdPKKCT", "fk_phieu_ke_khai_vpct_noi_vs_danh_muc_cls_IdPKKCT")->references("IdPKKCT")->on("phieu_ke_khai_vpct_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdDMCLS", "fk_phieu_ke_khai_vpct_noi_vs_danh_muc_cls_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc', function(Blueprint $table) {
            $table->foreign("IdPKKCT", "fk_phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc_IdPKKCT")->references("IdPKKCT")->on("phieu_ke_khai_vpct_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuoc", "fk_phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc_IdThuoc")->references("IdThuoc")->on("danh_muc_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('toa_thuoc_ct', function(Blueprint $table) {
            $table->foreign("IdTT", "fk_toa_thuoc_ct_IdTT")->references("IdTT")->on("toa_thuoc")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuoc", "fk_toa_thuoc_ct_IdThuoc")->references("IdThuoc")->on("danh_muc_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('toa_thuoc_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_toa_thuoc_vs_benh_an_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdTT", "fk_toa_thuoc_vs_benh_an_ngoai_tru_IdTT")->references("IdTT")->on("toa_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });

        Schema::table('toa_thuoc_vs_benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->foreign("IdBACT", "fk_toa_thuoc_vs_benh_an_noi_tru_ct_IdBACT")->references("IdBACT")->on("benh_an_noi_tru_ct")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdTT", "fk_toa_thuoc_vs_benh_an_noi_tru_ct_IdTT")->references("IdTT")->on("toa_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('anh_cls', function(Blueprint $table) {
            $table->foreign("IdKQCLS", "fk_anh_cls_IdKQCLS")->references("IdKQCLS")->on("ket_qua_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('ket_qua_cls_ct', function(Blueprint $table) {
            $table->foreign("IdKQCLS", "fk_ket_qua_cls_ct_IdKQCLS")->references("IdKQCLS")->on("ket_qua_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('ket_luan_cls', function(Blueprint $table) {
            $table->foreign("IdKQCLS", "fk_ket_luan_cls_IdKQCLS")->references("IdKQCLS")->on("ket_qua_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_benh_an_ngoai_tru_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('danh_muc_benh_vs_khoa', function(Blueprint $table) {
            $table->foreign("IdBenh", "fk_danh_muc_benh_vs_khoa_IdBenh")->references("IdBenh")->on("danh_muc_benh")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdKhoa", "fk_danh_muc_benh_vs_khoa_IdKhoa")->references("IdKhoa")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('danh_muc_cls_vs_khoa', function(Blueprint $table) {
            $table->foreign("IdDMCLS", "fk_danh_muc_cls_vs_khoa_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdKhoa", "fk_danh_muc_cls_vs_khoa_IdKhoa")->references("IdKhoa")->on("khoa")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('danh_muc_benh_vs_thuoc', function(Blueprint $table) {
            $table->foreign("IdBenh", "fk_danh_muc_benh_vs_thuoc_IdBenh")->references("IdBenh")->on("danh_muc_benh")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuoc", "fk_danh_muc_benh_vs_thuoc_IdThuoc")->references("IdThuoc")->on("danh_muc_thuoc")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chi_dinh_pt', function(Blueprint $table) {
            $table->foreign("IdBACT", "fk_chi_dinh_pt_IdBACT")->references("IdBACT")->on("benh_an_noi_tru_ct")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNVTH", "fk_chi_dinh_pt_IdNVTH")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdPB", "fk_chi_dinh_pt_IdPB")->references("IdPB")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdDMCLS", "fk_chi_dinh_pt_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chi_dinh_tt', function(Blueprint $table) {
            $table->foreign("IdNVTH", "fk_chi_dinh_tt_IdNVTH")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdPB", "fk_chi_dinh_tt_IdPB")->references("IdPB")->on("phong_ban")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdDMCLS", "fk_chi_dinh_tt_IdDMCLS")->references("IdDMCLS")->on("danh_muc_cls")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chi_dinh_tt_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_chi_dinh_tt_vs_benh_an_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuThuat", "fk_chi_dinh_tt_vs_benh_an_ngoai_tru_IdThuThuat")->references("IdThuThuat")->on("chi_dinh_tt")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('chi_dinh_tt_vs_benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->foreign("IdBACT", "fk_chi_dinh_tt_vs_benh_an_noi_tru_ct_IdBACT")->references("IdBACT")->on("benh_an_noi_tru_ct")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdThuThuat", "fk_chi_dinh_tt_vs_benh_an_noi_tru_ct_IdThuThuat")->references("IdThuThuat")->on("chi_dinh_tt")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('tam_ung_cls', function(Blueprint $table) {
            $table->foreign("IdCLS", "fk_tam_ung_IdCLS")->references("IdCLS")->on("can_lam_sang")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('tam_ung_pt', function(Blueprint $table) {
            $table->foreign("IdPT", "fk_tam_ung_IdPT")->references("IdPT")->on("chi_dinh_pt")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('tam_ung_tt', function(Blueprint $table) {
            $table->foreign("IdThuThuat", "fk_tam_ung_IdThuThuat")->references("IdThuThuat")->on("chi_dinh_tt")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('giay_chuyen_vien_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_giay_chuyen_vien_vs_benh_an_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('giay_chuyen_vien_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_giay_chuyen_vien_vs_benh_an_noi_tru_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('hoa_don_dv_ngoai_tru', function(Blueprint $table) {
            $table->foreign("IdBANgoaiT", "fk_hoa_don_dv_ngoai_tru_IdBANgoaiT")->references("IdBANgoaiT")->on("benh_an_ngoai_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNVLap", "fk_hoa_don_dv_ngoai_tru_IdNVLap")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('hoa_don_dv_noi_tru', function(Blueprint $table) {
            $table->foreign("IdBANoiT", "fk_hoa_don_dv_noi_tru_IdBANoiT")->references("IdBANoiT")->on("benh_an_noi_tru")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("IdNVLap", "fk_hoa_don_dv_noi_tru_IdNVLap")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        //---------------------Admin
        Schema::table('users', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_user_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('cham_cong_nv', function(Blueprint $table) {
            $table->foreign("IdNV", "fk_cham_cong_nv_IdNV")->references("IdNV")->on("nhan_vien")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('cap_them_quyen_user', function(Blueprint $table) {
            $table->foreign("IdUser", "fk_cap_them_quyen_user_IdUser")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('cap_them_quyen_user_ct', function(Blueprint $table) {
            $table->foreign("IdCQ", "fk_cap_them_quyen_user_ct_IdCQ")->references("IdCQ")->on("cap_them_quyen_user")->onUpdate("cascade")->onDelete("cascade");
        });
        
        Schema::table('ql_truy_cap', function(Blueprint $table) {
            $table->foreign("IdUser", "fk_ql_truy_cap_IdUser")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('ql_truy_cap_ct', function(Blueprint $table) {
            $table->foreign("IdQLTT", "fk_ql_truy_cap_ct_IdQLTT")->references("IdQLTT")->on("ql_truy_cap")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('ql_thao_tac', function(Blueprint $table) {
            $table->foreign("IdQLTTCT", "fk_ql_thao_tac_IdQLTTCT")->references("IdQLTTCT")->on("ql_truy_cap_ct")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('ql_phan_hoi', function(Blueprint $table) {
            $table->foreign("IdUser", "fk_ql_phan_hoi_IdUser")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            
        });
        
        Schema::table('password_resets', function(Blueprint $table) {
            $table->foreign("IdUser", "fk_password_resets_IdUser")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('benh_nhan', function(Blueprint $table) {
            $table->dropForeign("fk_benh_nhan_IdXa");
        });
        
        Schema::table('nhan_vien', function(Blueprint $table) {
            $table->dropForeign("fk_nhan_vien_IdXa");
            $table->dropForeign("fk_nhan_vien_IdPB");
        });
        
        Schema::table('chuc_vu_vs_nv', function(Blueprint $table) {
            $table->dropForeign("fk_chuc_vu_vs_nv_IdCV");
            $table->dropForeign("fk_chuc_vu_vs_nv_IdCV");
        });
        
        
        Schema::table('phieu_dk_kham', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_dk_kham_IdNV");
            $table->dropForeign("fk_phieu_dk_kham_IdBN");
            $table->dropForeign("fk_phieu_dk_kham_IdPK");
        });
        
        Schema::table('phieu_dk_kham_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_dk_kham_vs_benh_an_ngoai_tru_IdPhieuDKKB");
            $table->dropForeign("fk_phieu_dk_kham_vs_benh_an_ngoai_tru_IdBANgoaiT");
        });
        
        Schema::table('phieu_dk_kham_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_dk_kham_vs_benh_an_noi_tru_IdPhieuDKKB");
            $table->dropForeign("fk_phieu_dk_kham_vs_benh_an_noi_tru_IdBANoiT");
        });
        
        Schema::table('phong_ban', function(Blueprint $table) {
            $table->dropForeign("fk_phong_ban_IdKhoa");
        });
        
        Schema::table('phuong_xa', function(Blueprint $table) {
            $table->dropForeign("fk_phuong_xa_IdHuyen");
        });
        
        Schema::table('quan_huyen', function(Blueprint $table) {
            $table->dropForeign("fk_quan_huyen_IdTinh");
        });
        
        Schema::table('the_bhyt', function(Blueprint $table) {
            $table->dropForeign("fk_the_bhyt_IdCSKBHYT");
            $table->dropForeign("fk_the_bhyt_IdBN");
        });
        
        //---------------------
        
        Schema::table('benh_an_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_benh_an_noi_tru_IdNV");
            $table->dropForeign("fk_benh_an_noi_tru_IdGiuong");
        });
        
        Schema::table('benh_an_ngoai_tru_vs_can_lam_sang', function(Blueprint $table) {
            $table->dropForeign("fk_benh_an_ngoai_tru_vs_can_lam_sang_IdBANgoaiT");
            $table->dropForeign("fk_benh_an_ngoai_tru_vs_can_lam_sang_IdCLS");
        });
        
        Schema::table('benh_an_noi_tru_ct_vs_can_lam_sang', function(Blueprint $table) {
            $table->dropForeign("fk_benh_an_noi_tru_ct_vs_can_lam_sang_IdBACT");
            $table->dropForeign("fk_benh_an_noi_tru_ct_vs_can_lam_sang_IdCLS");
        });
        
        Schema::table('benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->dropForeign("fk_benh_an_noi_tru_ct_IdBANoiT");
        });
        
        Schema::table('can_lam_sang', function(Blueprint $table) {
            $table->dropForeign("fk_can_lam_sang_IdPB");
            $table->dropForeign("fk_can_lam_sang_IdDMCLS");
        });
        
        Schema::table('chuan_doan_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_chuan_doan_vs_benh_an_ngoai_tru_IdBANgoaiT");
            $table->dropForeign("fk_chuan_doan_vs_benh_an_ngoai_tru_IdBenh");
        });
        
        Schema::table('chuan_doan_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_chuan_doan_vs_benh_an_noi_tru_IdBANoiT");
            $table->dropForeign("fk_chuan_doan_vs_benh_an_noi_tru_IdBenh");
        });
        
        Schema::table('chuan_doan_vs_ket_qua_cls', function(Blueprint $table) {
            $table->dropForeign("fk_chuan_doan_vs_ket_qua_cls_IdBenh");
            $table->dropForeign("fk_chuan_doan_vs_ket_qua_cls_IdKQCLS");
        });
        
        Schema::table('giay_ra_vien', function(Blueprint $table) {
            $table->dropForeign("fk_giay_ra_vien_IdBANoiT");
        });
        
        Schema::table('thiet_bi_yt', function(Blueprint $table) {
            $table->dropForeign("fk_thiet_bi_yt_IdPB");
        });
        
        Schema::table('ket_qua_cls', function(Blueprint $table) {
            $table->dropForeign("fk_ket_qua_cls_IdCLS");
            $table->dropForeign("fk_ket_qua_cls_IdNVTH");
        });
        
        Schema::table('phieu_ke_khai_vp_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vp_ngoai_tru_IdBANgoaiT");
        });
        
        Schema::table('phieu_ke_khai_vp_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vp_noi_tru_IdBANoiT");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_ngoai_tru_IdPKK");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls_IdPKKCT");
            $table->dropForeign("fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_cls_IdDMCLS");
        });
        
        Schema::table('phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc_IdPKKCT");
            $table->dropForeign("fk_phieu_ke_khai_vpct_ngoai_vs_danh_muc_thuoc_IdThuoc");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_noi_tru_IdPKK");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_vs_danh_muc_cls', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_noi_vs_danh_muc_cls_IdPKKCT");
            $table->dropForeign("fk_phieu_ke_khai_vpct_noi_vs_danh_muc_cls_IdDMCLS");
        });
        
        Schema::table('phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc', function(Blueprint $table) {
            $table->dropForeign("fk_phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc_IdPKKCT");
            $table->dropForeign("fk_phieu_ke_khai_vpct_noi_vs_danh_muc_thuoc_IdThuoc");
        });
        
        Schema::table('toa_thuoc_ct', function(Blueprint $table) {
            $table->dropForeign("fk_toa_thuoc_ct_IdTT");
            $table->dropForeign("fk_toa_thuoc_ct_IdThuoc");
        });

        Schema::table('toa_thuoc_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_toa_thuoc_vs_benh_an_ngoai_tru_IdBANgoaiT");
            $table->dropForeign("fk_toa_thuoc_vs_benh_an_ngoai_tru_IdTT");
        });

        Schema::table('toa_thuoc_vs_benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->dropForeign("fk_toa_thuoc_vs_benh_an_noi_tru_ct_IdBACT");
            $table->dropForeign("fk_toa_thuoc_vs_benh_an_noi_tru_ct_IdTT");
        });
        
        Schema::table('anh_cls', function(Blueprint $table) {
            $table->dropForeign("fk_anh_cls_IdKQCLS");
        });
        
        Schema::table('ket_qua_cls_ct', function(Blueprint $table) {
            $table->dropForeign("fk_ket_qua_cls_ct_IdKQCLS");
        });
        
        Schema::table('ket_luan_cls', function(Blueprint $table) {
            $table->dropForeign("fk_ket_luan_cls_IdKQCLS");
        });
        
        Schema::table('benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_benh_an_ngoai_tru_IdNV");
        });
        
        Schema::table('danh_muc_benh_vs_khoa', function(Blueprint $table) {
            $table->dropForeign("fk_danh_muc_benh_vs_khoa_IdBenh");
            $table->dropForeign("fk_danh_muc_benh_vs_khoa_IdKhoa");
        });
        
        Schema::table('danh_muc_cls_vs_khoa', function(Blueprint $table) {
            $table->dropForeign("fk_danh_muc_cls_vs_khoa_IdDMCLS");
            $table->dropForeign("fk_danh_muc_cls_vs_khoa_IdKhoa");
        });
        
        Schema::table('chi_dinh_pt', function(Blueprint $table) {
            $table->dropForeign("fk_chi_dinh_pt_IdBACT");
            $table->dropForeign("fk_chi_dinh_pt_IdNVTH");
            $table->dropForeign("fk_chi_dinh_pt_IdPB");
            $table->dropForeign("fk_chi_dinh_pt_IdDMCLS");
        });
        
        Schema::table('chi_dinh_tt', function(Blueprint $table) {
            $table->dropForeign("fk_chi_dinh_tt_IdNVTH");
            $table->dropForeign("fk_chi_dinh_tt_IdPB");
            $table->dropForeign("fk_chi_dinh_tt_IdDMCLS");
        });
        
        Schema::table('chi_dinh_tt_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_chi_dinh_tt_vs_benh_an_ngoai_tru_IdBANgoaiT");
            $table->dropForeign("fk_chi_dinh_tt_vs_benh_an_ngoai_tru_IdThuThuat");
        });
        
        Schema::table('chi_dinh_tt_vs_benh_an_noi_tru_ct', function(Blueprint $table) {
            $table->dropForeign("fk_chi_dinh_tt_vs_benh_an_noi_tru_ct_IdBACT");
            $table->dropForeign("fk_chi_dinh_tt_vs_benh_an_noi_tru_ct_IdThuThuat");
        });
        
        Schema::table('tam_ung_cls', function(Blueprint $table) {
            $table->dropForeign("fk_tam_ung_IdCLS");
        });
        
        Schema::table('tam_ung_pt', function(Blueprint $table) {
            $table->dropForeign("fk_tam_ung_IdPT");
        });
        
        Schema::table('tam_ung_tt', function(Blueprint $table) {
            $table->dropForeign("fk_tam_ung_IdThuThuat");
        });
        
        Schema::table('giay_chuyen_vien_vs_benh_an_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_giay_chuyen_vien_vs_benh_an_ngoai_tru_IdBANgoaiT");
        });
        
        Schema::table('giay_chuyen_vien_vs_benh_an_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_giay_chuyen_vien_vs_benh_an_noi_tru_IdBANoiT");
        });
        
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign("fk_user_IdNV");
        });
        
        
        Schema::table('cham_cong_nv', function(Blueprint $table) {
            $table->dropForeign("fk_cham_cong_nv_IdNV");
        });
        
        Schema::table('cap_them_quyen_user', function(Blueprint $table) {
            $table->dropForeign("fk_cap_them_quyen_user_IdUser");
        });
        
        Schema::table('cap_them_quyen_user_ct', function(Blueprint $table) {
            $table->dropForeign("fk_cap_them_quyen_user_ct_IdCQ");
        });
        
        Schema::table('ql_truy_cap', function(Blueprint $table) {
            $table->dropForeign("fk_ql_truy_cap_IdUser");
            
        });
        
        Schema::table('ql_truy_cap_ct', function(Blueprint $table) {
            $table->dropForeign("fk_ql_truy_cap_ct_IdQLTT");
            
        });
        
        Schema::table('ql_thao_tac', function(Blueprint $table) {
            $table->dropForeign("fk_ql_thao_tac_IdQLTTCT");
            
        });
        
        Schema::table('ql_phan_hoi', function(Blueprint $table) {
            $table->dropForeign("fk_ql_phan_hoi_IdUser");
            
        });
        
        Schema::table('password_resets', function(Blueprint $table) {
            $table->dropForeign("fk_password_resets_IdUser");
        });
        
        Schema::table('hoa_don_dv_ngoai_tru', function(Blueprint $table) {
            $table->dropForeign("fk_hoa_don_dv_ngoai_tru_IdBANgoaiT");
            $table->dropForeign("fk_hoa_don_dv_ngoai_tru_IdNVLap");
        });
        
        Schema::table('hoa_don_dv_noi_tru', function(Blueprint $table) {
            $table->dropForeign("fk_hoa_don_dv_noi_tru_IdBANoiT");
            $table->dropForeign("fk_hoa_don_dv_noi_tru_IdNVLap");
        });
        
        Schema::table('danh_muc_benh_vs_thuoc', function(Blueprint $table) {
            $table->dropForeign("fk_danh_muc_benh_vs_thuoc_IdBenh");
            $table->dropForeign("fk_danh_muc_benh_vs_thuoc_IdThuoc");
        });
        
        Schema::table('ba_nv', function(Blueprint $table) {
            $table->dropForeign("fk_ba_nv_IdBANoiT");
            $table->dropForeign("fk_ba_nv_IdNV");
        });
        
        Schema::table('thong_ke', function(Blueprint $table) {
            $table->dropForeign("fk_thong_ke_IdNV");
        });

        Schema::table('file_tk', function(Blueprint $table) {
            $table->dropForeign("fk_file_tk_IdTK");
        });

        Schema::table('duyet_tk', function(Blueprint $table) {
            $table->dropForeign("fk_duyet_tk_IdCV");
            $table->dropForeign("fk_duyet_tk_IdNV");
        });
    }
}
