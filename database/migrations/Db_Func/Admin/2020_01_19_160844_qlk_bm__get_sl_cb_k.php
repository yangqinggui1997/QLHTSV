<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetSlCbK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS qlk_bm__get_sl_cb_k');
        $sql = '
        CREATE FUNCTION qlk_bm__get_sl_cb_k(idKhoa VARCHAR(255)) RETURNS INT UNSIGNED RETURN(SELECT COUNT(cb.`idCB`) FROM khoa AS k JOIN phong_ban AS pb ON k.`idKhoa` = pb.`idKhoa` JOIN can_bo_giang_vien AS cb ON pb.`idPhong` = cb.`idPhong` WHERE k.`idkhoa` = idKhoa LIMIT 1)';
        DB::unprepared($sql);
    }
}
