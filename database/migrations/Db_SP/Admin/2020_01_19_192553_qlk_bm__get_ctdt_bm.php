<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetCtdtBm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS qlk_bm__get_ctdt_bm');
        $sql = '
        CREATE PROCEDURE qlk_bm__get_ctdt_bm(idPhong VARCHAR(255)) SELECT ctdt.`capHDT`,ctdt.`heDaoTao`,pb.`tenPhong` AS `tenCTDT` FROM phong_ban AS pb JOIN chuong_trinh_dao_tao AS ctdt ON pb.`idPhong` = ctdt.`idPhong` WHERE pb.`idPhong` = idPhong ORDER BY ctdt.`capHDT` ASC';
        DB::unprepared($sql);
    }
}
