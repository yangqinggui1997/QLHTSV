<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetDsCbK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS qlk_bm__get_ds_cb_k');
        $sql = '
        CREATE PROCEDURE qlk_bm__get_ds_cb_k(idKhoa VARCHAR(255)) SELECT cb.* FROM khoa AS k JOIN phong_ban AS pb ON k.`idKhoa` = pb.`idKhoa` JOIN can_bo_giang_vien AS cb ON pb.`idPhong` = cb.`idPhong` WHERE k.`idkhoa` = idKhoa ORDER BY cb.`hoTen` ASC';
        DB::unprepared($sql);
    }
}
