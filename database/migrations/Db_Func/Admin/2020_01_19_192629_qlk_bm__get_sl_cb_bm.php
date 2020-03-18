<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QlkBmGetSlCbBm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS qlk_bm__get_sl_cb_bm');
        $sql = '
        CREATE FUNCTION qlk_bm__get_sl_cb_bm(idPhong VARCHAR(255)) RETURNS INT UNSIGNED RETURN(SELECT COUNT(cb.`idCB`) FROM phong_ban AS pb JOIN can_bo_giang_vien AS cb ON pb.`idPhong` = cb.`idPhong` WHERE pb.`idPhong` = idPhong LIMIT 1)';
        DB::unprepared($sql);
    }
}
