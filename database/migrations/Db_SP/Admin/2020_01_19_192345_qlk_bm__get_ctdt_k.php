<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetCtdtK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS qlk_bm__get_ctdt_k');
        $sql = '
        CREATE PROCEDURE qlk_bm__get_ctdt_k(idKhoa VARCHAR(255)) SELECT ctdt.`capHDT`,ctdt.`heDaoTao`,pb.`tenPhong` AS `tenCTDT` FROM khoa AS k JOIN phong_ban AS pb ON k.`idKhoa` = pb.`idKhoa` JOIN chuong_trinh_dao_tao AS ctdt ON pb.`idPhong` = ctdt.`idPhong` WHERE k.`idkhoa` = idKhoa ORDER BY ctdt.`capHDT` ASC';
        DB::unprepared($sql);
    }
}
